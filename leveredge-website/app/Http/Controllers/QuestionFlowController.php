<?php

namespace App\Http\Controllers;

use App\Events\QuestionFlowValidationError;
use App\Exceptions\AuthPersistException;
use App\Notifications\NotFoundSlackNotifications;
use App\Notifications\QuestionFlowValidationSlackNotification;
use App\Providers\App\Events\QuestionFlowCompleted;
use App\Providers\App\Events\QuestionFlowStarted;
use App\QuestionFlow;
use App\QuestionPage;
use App\Traits\InteractsWithResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class QuestionFlowController extends Controller
{
    use InteractsWithResponder;

    public function questionFlowStartPage(QuestionFlow $questionFlow)
    {
        if (! $questionFlow->started()) {
            list($responder_id, $responder_type) = $this->getResponderIdAndType();

            $questionFlow->questionFlowResponders()->create([
                'responder_id'     => $responder_id,
                'responder_type'   => $responder_type,
                'started_at'       => now(),
            ]);

            $this->startFlow(request(), $questionFlow);
        }

        return redirect()->to($questionFlow->getFirstQuestionPageUrl());
    }

    public function show(Request  $request, QuestionFlow $questionFlow, QuestionPage $questionPage)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->ensureQuestionPageIsChildOfQuestionFlow($questionFlow, $questionPage);

        if ($questionFlow->authorization_policy && class_exists($questionFlow->authorization_policy)) {
            try {
                dispatch(new $questionFlow->authorization_policy);
            } catch (AuthPersistException $exception) {
                session()->put('url.intended', request()->getPathInfo());

                return redirect()->to('/login');
            }
        }

        if ($questionPage->isFirstPageInFlow() && ! $questionFlow->started()) {
            $this->startFlow($request, $questionFlow, $questionPage);
        }

        if ($questionPage->shouldSkip()) {
            $nextPage = $questionFlow->nextPage($questionPage);
            if ($nextPage) {
                return redirect($nextPage->url);
            }

            return $this->completeFlow($request, $questionFlow, $questionPage);
        }
        $questionPage->getQuestionPageResponder()->setShownAt();

        if ($questionPage->pre_render_redirect && class_exists($questionPage->pre_render_redirect)) {
            return redirect()->to((new $questionPage->pre_render_redirect)->url());
        }

        return view($questionPage->show_view)->with(compact(['questionPage']));
    }

    public function save(Request $request, QuestionFlow $questionFlow, QuestionPage $questionPage)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->ensureQuestionPageIsChildOfQuestionFlow($questionFlow, $questionPage);

        $validationRules = $questionPage->getValidationRules();

        try {
            $request->validate($validationRules);
        } catch (ValidationException $exception) {
            $questionData  = [
                'question_flow_id'   => $questionFlow->id,
                'question_flow_slug' => $questionFlow->slug,
                'question_page_id'   => $questionPage->id,
                'question_page_slug' => $questionPage->slug,
            ];
            $userOrClient = user();
            if (! auth()->check()) {
                $userOrClient = getClient();
            }

            event(new QuestionFlowValidationError($exception->errors(),
                $exception->validator->failed(),
                $request->all(),
                $questionData,
                $userOrClient));

            return back()->withErrors($exception->errors())->withInput($request->all());
        }

        foreach ($questionPage->questions as $question) {
            $question->persistResponse();
        }
        $questionPage->getQuestionPageResponder()->setPostedAt();
        if ($questionPage->isLastPageInFlow()) {
            return $this->completeFlow($request, $questionFlow, $questionPage);
        }

        return redirect($questionPage->nextPageInFlow()->url);
    }

    protected function ensureQuestionPageIsChildOfQuestionFlow($questionFlow, $questionPage)
    {
        if ($questionFlow->id !== $questionPage->question_flow_id) {
            /** @noinspection PhpUnhandledExceptionInspection */
            throw new \Exception('QuestionPage is not related to QuestionFlow');
        }
    }

    protected function startFlow(Request $request, QuestionFlow $questionFlow)
    {
        $questionFlow->runStartSequence();
        event(new QuestionFlowStarted($questionFlow, user()));
    }

    protected function completeFlow(Request $request, QuestionFlow $questionFlow)
    {
        $questionFlow->runCompleteSequence();
        event(new QuestionFlowCompleted($questionFlow));

        return redirect()->to($questionFlow->getRedirectUrl());
    }
}
