<?php


namespace App\PersistResponse;

use App\Contracts\PersistResponseInterface;
use App\Question;
use App\Traits\PersistResponses\EnsureColumnExistsInTableTrait;

class PersistOnUserProfileModel extends PersistInQuestionResponderOnly implements PersistResponseInterface
{
    use EnsureColumnExistsInTableTrait;

    public function __construct($bypassCheck = false)
    {
        if (!$bypassCheck && !auth()->check()) {
            /** @noinspection PhpUnhandledExceptionInspection */
            throw new \Exception(self::class . ' should only be used for logged in question flows');
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
        $user       = user();
        $profile    = $user->profile;
        $fieldValue = $request->$fieldName;
        if ($needToSaveFromResponder) {
            $responder           = app('client_question_responders')->where('question_id', $question->id)->first();
            if ($responder) {
                $fieldValue = $responder->response;
            }
        }
        if ($fieldValue) {
            $profile->$fieldName = $fieldValue;
            $profile->save();
        }
    }

    public function getPersistedValue(Question $question)
    {
        if (auth()->check()) {
            $fieldName  = $question->field_name;
            $user       = user();
            $profile    = $user->profile;

            return $profile->$fieldName;
        }
        $responder = app('client_question_responders')->where('question_id', $question->id)->sortByDesc('created_at')->first();
//
        if ($responder) {
            return $responder->response;
        }

        return null;
    }

    public function getTableName(): string
    {
        return 'user_profiles';
    }
}
