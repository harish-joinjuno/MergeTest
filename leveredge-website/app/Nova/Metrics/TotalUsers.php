<?php

namespace App\Nova\Metrics;

use App\User;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class TotalUsers extends Value
{
    public function calculate(Request $request)
    {
        return $this->count($request, User::class);
    }

    public function ranges()
    {
        return [
            7 => '1 Week',
            30 => '30 Days',
            60 => '60 Days',
            365 => '365 Days',
            'TODAY' => 'Today',
            'MTD' => 'Month To Date',
            'QTD' => 'Quarter To Date',
            'YTD' => 'Year To Date',
        ];
    }

    public function uriKey()
    {
        return 'total-users';
    }
}
