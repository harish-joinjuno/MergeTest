<?php


namespace App\SkipPolicies;


use App\UserProfile;

class TempIfWentToGraduateSchoolIsYesAndIfImmigrationStatusIsUsCitizen implements \App\Contracts\SkipPolicyInterface
{

    public function check()
    {
        $profile = userProfile();

        return strtolower($profile->went_to_graduate_school) === 'yes' && $profile->immigration_status === UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT;
    }
}
