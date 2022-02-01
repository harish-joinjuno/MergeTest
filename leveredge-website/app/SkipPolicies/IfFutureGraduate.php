<?php


namespace App\SkipPolicies;


use Carbon\Carbon;

class IfFutureGraduate implements \App\Contracts\SkipPolicyInterface
{

    public function check()
    {
        $profile = userProfile();

        if ($profile->graduate_month_year) {
            return now()->isBefore(Carbon::createFromFormat('Y-m-d', $profile->graduate_month_year));
        }

        if ($profile->undergraduate_month_year) {
            return now()->isBefore(Carbon::createFromFormat('Y-m-d', $profile->undergraduate_month_year));
        }

        return false;
    }
}
