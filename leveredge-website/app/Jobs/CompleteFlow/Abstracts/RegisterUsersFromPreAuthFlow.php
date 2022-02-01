<?php


namespace App\Jobs\CompleteFlow\Abstracts;

use App\Mail\CreatePasswordEmail;
use App\Question;
use App\QuestionFlow;
use App\QuestionPage;
use App\QuestionResponder;
use App\Traits\InteractsWithResponder;
use App\Traits\registersBorrowers;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

abstract class RegisterUsersFromPreAuthFlow
{
    use registersBorrowers,
        InteractsWithResponder;

    public function handle()
    {
        if (! auth()->check()) {
            list($responder_id, $responder_type) = $this->getResponderIdAndType();
            $questionFlow                        = $this->getQuestionFlow();
            $questionPagesIds                    = $questionFlow->questionPages->pluck('id');

            $emailQuestion = Question::whereIn('question_page_id', $questionPagesIds)->where('field_name', 'email')->first();

            $emailResponse = QuestionResponder::whereQuestionId($emailQuestion->id)
                ->whereResponderId($responder_id)
                ->whereResponderType($responder_type)
                ->orderBy('id', 'desc')
                ->first();

            if (User::whereEmail($emailResponse->response)->exists()) {
                throw new \Exception('Existing user should be logged in to use this flow');
            }
            $user    = $this->create([
                    'email'    => $emailResponse->response,
                    'password' => Str::random(8),
                ]);

            $this->createBorrowerProfile($user);
            event(new Registered($user));
            Mail::to($user->email)->send(new CreatePasswordEmail($user));
            auth()->loginUsingId($user->id);


            $questionFlow
                ->questionPages
                ->each(function (QuestionPage $questionPage) {
                    $questionPage
                        ->questions
                        ->each(function (Question $question) {
                            $question->persistResponse(true);
                        });
                });
        }
    }

    abstract public function getQuestionFlow(): QuestionFlow;
}
