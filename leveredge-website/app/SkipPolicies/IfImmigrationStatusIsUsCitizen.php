<?php


namespace App\SkipPolicies;


use App\UserProfile;

class IfImmigrationStatusIsUsCitizen implements \App\Contracts\SkipPolicyInterface
{

    public function check()
    {
        if (auth()->check()) {
            return userProfile()->immigration_status === UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT;
        }

        $responder = app('client_question_responders')->whereIn('question_id', [6,25,66, 101])->first();

        if ($responder) {
            return $responder->response === UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT;
        }

        return false;

    }
}
