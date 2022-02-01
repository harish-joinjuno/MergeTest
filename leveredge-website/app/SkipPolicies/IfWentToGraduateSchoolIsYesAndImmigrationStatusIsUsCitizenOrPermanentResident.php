<?php


namespace App\SkipPolicies;

use App\Question;
use App\UserProfile;

class IfWentToGraduateSchoolIsYesAndImmigrationStatusIsUsCitizenOrPermanentResident implements \App\Contracts\SkipPolicyInterface
{
    public function check()
    {
        if (auth()->check()) {
            return userProfile()->immigration_status                  === UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT
                && strtolower(userProfile()->went_to_graduate_school) === 'yes';
        }

        $immigrationStatusResponder = app('client_question_responders')->whereIn('question_id', Question::IMMIGRATION_QUESTION_IDS)->first();
        $graduateResponder          = app('client_question_responders')->where('question_id', Question::GRADUATE_QUESTION_ID)->first();

        if ($immigrationStatusResponder && $graduateResponder) {
            return $immigrationStatusResponder->response    === UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT
                && strtolower($graduateResponder->response) === 'yes';
        }

        return false;
    }
}
