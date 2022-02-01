<?php


namespace App\PersistResponse;


use App\Contracts\PersistResponseInterface;
use App\Question;
use App\Traits\PersistResponses\EnsureColumnExistsInTableTrait;
use App\UserProfileHeardFromOther;

class PersistOnUserProfileHeardFromOther extends PersistInQuestionResponderOnly implements PersistResponseInterface
{
    use EnsureColumnExistsInTableTrait;

    /**
     * @inheritDoc
     */
    public function persist(Question $question, $needToSaveFromResponder = false)
    {
        parent::persist($question);

        $request     = request();
        $fieldName   = $question->field_name;
        $userProfile = userProfile();
        $fieldValue  = $request->$fieldName;
        if ($needToSaveFromResponder) {
            $responder = app('client_question_responders')->where('question_id', $question->id)->first();
            if ($responder) {
                $fieldValue = $responder->response;
            }
        }

        if ($fieldValue) {
            if (! $userProfileHeardFromOther = UserProfileHeardFromOther::whereUserProfileId($userProfile->id)->first()) {
                $userProfileHeardFromOther                  = new UserProfileHeardFromOther();
                $userProfileHeardFromOther->user_profile_id = $userProfile->id;
            }
            $userProfileHeardFromOther->$fieldName = $fieldValue;
            $userProfileHeardFromOther->save();
        }
    }

    function getTableName(): string
    {
        return 'user_profile_heard_from_others';
    }
}
