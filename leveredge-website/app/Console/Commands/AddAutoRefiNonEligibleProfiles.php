<?php

namespace App\Console\Commands;

use App\NegotiationGroup;
use App\NegotiationGroupEligibleProfile;
use App\NegotiationGroupUser;
use Illuminate\Console\Command;

class AddAutoRefiNonEligibleProfiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-refi:non-eligibles';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $rules = [
            'vehicle_year'                => 2014,
            'payoff_amount_below'         => 12000,
            'income_below'                => 36000,
            'credit_score'                => 'Less than 500',
        ];

        foreach ($rules as $column => $value) {
            $ngEligibleProfile                       = new NegotiationGroupEligibleProfile();
            $ngEligibleProfile->$column              = $value;
            $ngEligibleProfile->negotiation_group_id = 25;
            $ngEligibleProfile->save();
        }

        $autoRefiNgUsers  = NegotiationGroupUser::where('negotiation_group_id', 20)->get();
        $negotiationGroup = NegotiationGroup::find(25);
        $autoRefiNgUsers->each(function (NegotiationGroupUser $ngUser) use ($negotiationGroup) {
            $eligibleProfile = $ngUser->user->profile->matchingEligibleProfile($negotiationGroup);
            if ($eligibleProfile) {
                $ngUser->negotiation_group_eligible_profile_id = $eligibleProfile->id;
                $ngUser->negotiation_group_id = 25;
                $ngUser->save();
            }
        });
    }
}
