<?php


namespace App\PersistResponse;

use App\AutoRefinanceApplication;
use App\Contracts\PersistResponseInterface;
use App\Question;
use App\Traits\PersistResponses\EnsureColumnExistsInTableTrait;

class PersistOnAutoRefinanceApplication extends PersistInQuestionResponderOnly implements PersistResponseInterface
{
    use EnsureColumnExistsInTableTrait;

    public function __construct($byPassCheck = false)
    {
        if (! $byPassCheck) {
            if (!auth()->check()) {
                throw new \Exception('User must be logged in to use this persist method');
            }

            if (is_null($this->getLatestAutoRefinanceApplication()) && ! auth()->user()->isAdmin()) {
                throw new \Exception('User does not have an existing auto refinance application');
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function persist(Question $question, $needToSaveFromResponder = false)
    {
        parent::persist($question);

        $request    = request();
        $fieldName  = $question->field_name;
        $fieldValue = $request->$fieldName;
        if ($needToSaveFromResponder) {
            $responder = app('client_question_responders')->where('question_id', $question->id)->first();
            if ($responder) {
                $fieldValue = $responder->response;
            }
        }

        if ($fieldValue) {
            $latestAutoRefinanceApplication = $this->getLatestAutoRefinanceApplication();

            $latestAutoRefinanceApplication->$fieldName = $fieldValue;
            $latestAutoRefinanceApplication->save();
        }
    }

    public function getPersistedValue(Question $question)
    {
        if (auth()->check()) {
            $fieldName                      = $question->field_name;
            $latestAutoRefinanceApplication = $this->getLatestAutoRefinanceApplication();

            return $latestAutoRefinanceApplication->$fieldName;
        }

        $responder = app('client_question_responders')->where('question_id', $question->id)->first();

        if ($responder) {
            return $responder->response;
        }

        return null;
    }

    public function getTableName(): string
    {
        return 'auto_refinance_applications';
    }

    protected function getLatestAutoRefinanceApplication()
    {
        $autoToLoadApplication = user()->autoRefinanceApplications()->orderBy('id','desc')->first();

        if (! $autoToLoadApplication) {
            $autoToLoadApplication = AutoRefinanceApplication::firstOrCreate([
                'client_id' => getClientId(),
                'user_id'   => user()->id,
            ]);
        }

        return $autoToLoadApplication;
    }
}
