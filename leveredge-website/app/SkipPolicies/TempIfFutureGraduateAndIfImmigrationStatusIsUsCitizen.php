<?php


namespace App\SkipPolicies;

use App\Contracts\SkipPolicyInterface;
use App\UserProfile;
use Carbon\Carbon;

class TempIfFutureGraduateAndIfImmigrationStatusIsUsCitizen implements SkipPolicyInterface
{
    public function check()
    {
        $profile        = userProfile();
        $futureGraduate = false;

        if ($profile->graduate_month_year) {
            $futureGraduate = now()->isBefore(Carbon::createFromFormat('Y-m-d', $profile->graduate_month_year));
        }

        if ($profile->undergraduate_month_year) {
            $futureGraduate = now()->isBefore(Carbon::createFromFormat('Y-m-d', $profile->undergraduate_month_year));
        }

        return $futureGraduate && $profile->immigration_status === UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT;
    }
}
