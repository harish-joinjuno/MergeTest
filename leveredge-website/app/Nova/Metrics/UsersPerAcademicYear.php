<?php

namespace App\Nova\Metrics;

use App\AcademicYear;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class UsersPerAcademicYear extends Partition
{
    public function calculate(Request $request)
    {
        return $this->result(
            (new AcademicYear)
                ->withCount('users')
                ->orderBy('users_count', 'DESC')
                ->havingRaw('users_count > 0')
                ->get()
                ->pluck('users_count', 'name')
                ->toArray()
        );
    }

    public function uriKey()
    {
        return 'users-per-academic-year';
    }
}
