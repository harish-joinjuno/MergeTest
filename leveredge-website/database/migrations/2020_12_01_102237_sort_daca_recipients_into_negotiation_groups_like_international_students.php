<?php

use App\NegotiationGroupEligibleProfile;
use App\UserProfile;
use Illuminate\Database\Migrations\Migration;

class SortDacaRecipientsIntoNegotiationGroupsLikeInternationalStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        NegotiationGroupEligibleProfile::where('immigration_status', UserProfile::IMMIGRATION_STATUS_OTHER)
            ->whereIn('negotiation_group_id', [1,11,12,13])
            ->each(function (NegotiationGroupEligibleProfile $negotiationGroupEligibleProfile) {
                $newEligibleProfile = $negotiationGroupEligibleProfile->replicate();
                $newEligibleProfile->immigration_status = \App\UserProfile::IMMIGRATION_STATUS_DACA_RECIPIENT;
                $newEligibleProfile->save();
                if ($negotiationGroupEligibleProfile->negotiation_group_id === 1) {
                    $newEligibleProfile = $negotiationGroupEligibleProfile->replicate();
                    $newEligibleProfile->immigration_status = \App\UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT;
                    $newEligibleProfile->save();
                }
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
