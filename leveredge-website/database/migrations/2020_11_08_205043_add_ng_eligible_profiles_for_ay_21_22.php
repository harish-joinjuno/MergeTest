<?php

use App\NegotiationGroup;
use App\NegotiationGroupEligibleProfile;
use App\UserProfile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNgEligibleProfilesForAy2122 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! (app()->runningInConsole() && app()->runningUnitTests())) {
            $eligibleProfiles = [
                [
                    'negotiation_group_id' => NegotiationGroup::NG_DOMESTIC_GROUP_21_22,
                    'immigration_status'   => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                ],
                [
                    'negotiation_group_id' => NegotiationGroup::NG_INTERNATIONAL_GROUP_21_22,
                    'immigration_status'   => UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT,
                ],
                [
                    'negotiation_group_id' => NegotiationGroup::NG_INTERNATIONAL_GROUP_21_22,
                    'immigration_status'   => UserProfile::IMMIGRATION_STATUS_DACA_RECIPIENT,
                ],
                [
                    'negotiation_group_id' => NegotiationGroup::NG_INTERNATIONAL_GROUP_21_22,
                    'immigration_status'   => UserProfile::IMMIGRATION_STATUS_OTHER,
                ],
            ];

            foreach ($eligibleProfiles as $eligibleProfile) {
                NegotiationGroupEligibleProfile::create($eligibleProfile);
            }
        }
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
