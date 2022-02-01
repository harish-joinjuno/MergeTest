<?php


namespace App\SkipPolicies;


use App\Question;
use App\UserProfile;
use Carbon\Carbon;

class IfImmigrationStatusIsNotUsCitizen implements \App\Contracts\SkipPolicyInterface
{

    public function check()
    {
        if (auth()->check()) {
            return userProfile()->immigration_status !== UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT;
        }

        $responder = app('client_question_responders')->whereIn('question_id', Question::IMMIGRATION_QUESTION_IDS)->first();

        if ($responder) {
            return $responder->response !== UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT;
        }

        return false;
    }
}
