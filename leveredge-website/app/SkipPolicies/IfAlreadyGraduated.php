<?php


namespace App\SkipPolicies;

use Carbon\Carbon;

class IfAlreadyGraduated implements \App\Contracts\SkipPolicyInterface
{
    public function check()
    {
        $profile = userProfile();

        if ($profile->graduate_month_year) {
            $date = Carbon::createFromFormat('Y-m-d', $profile->graduate_month_year);

            return now()->isAfter($date) || $date->isToday();
        }

        if ($profile->undergraduate_month_year) {
            $date = Carbon::createFromFormat('Y-m-d', $profile->undergraduate_month_year);
            return now()->isAfter($date) || $date->isToday();
        }

        return false;
    }
}
