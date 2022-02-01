<?php

namespace App\Nova\Metrics;

use App\NegotiationGroup;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class UsersPerNegotiationGroup extends Partition
{
    public function calculate(Request $request)
    {
        return $this->result(
            (new NegotiationGroup)
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
        return 'users-per-negotiation-group';
    }
}
