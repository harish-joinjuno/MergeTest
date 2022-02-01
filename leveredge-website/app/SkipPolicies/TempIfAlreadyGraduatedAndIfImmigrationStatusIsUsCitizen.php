<?php


namespace App\SkipPolicies;

use App\Contracts\SkipPolicyInterface;
use App\UserProfile;
use Carbon\Carbon;

class TempIfAlreadyGraduatedAndIfImmigrationStatusIsUsCitizen implements SkipPolicyInterface
{
    public function check()
    {
        $profile          = userProfile();
        $alreadyGraduated = false;

        if ($profile->graduate_month_year) {
            $date = Carbon::createFromFormat('Y-m-d', $profile->graduate_month_year);

            $alreadyGraduated = now()->isAfter($date) || $date->isToday();
        }

        if ($profile->undergraduate_month_year) {
            $date             = Carbon::createFromFormat('Y-m-d', $profile->undergraduate_month_year);
            $alreadyGraduated = now()->isAfter($date) || $date->isToday();
        }

        return $alreadyGraduated && $profile->immigration_status === UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT;
    }
}
