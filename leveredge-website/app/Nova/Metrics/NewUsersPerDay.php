<?php

namespace App\Nova\Metrics;

use App\User;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Trend;

class NewUsersPerDay extends Trend
{
    public function calculate(Request $request)
    {
        return $this->countByDays($request, User::class);
    }

    public function ranges()
    {
        return [
            15 => '15 Days',
            30 => '30 Days',
            60 => '60 Days',
            90 => '90 Days',
        ];
    }

    public function uriKey()
    {
        return 'new-users-per-day';
    }
}
