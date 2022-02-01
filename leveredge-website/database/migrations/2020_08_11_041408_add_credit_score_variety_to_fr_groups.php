<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreditScoreVarietyToFrGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $eligibleForFRCreditScores = [
            "700 - 749",
            "750 - 799",
            "Above 800",
        ];

        $negotiationGroupEligibleProfiles = \App\NegotiationGroupEligibleProfile::whereIn('negotiation_group_id',[
            \App\NegotiationGroup::NG_NON_MEDICAL_IN_FR_CITIES,
            \App\NegotiationGroup::NG_MEDICAL_IN_FR_CITIES,
        ])->get();

        /** @var \App\NegotiationGroupEligibleProfile $profile */
        foreach ($negotiationGroupEligibleProfiles as $profile) {
            // Update it and add 2 more
            $profile->credit_score = $eligibleForFRCreditScores[0];
            $profile->save();

            $secondProfile               = $profile->replicate();
            $secondProfile->credit_score = $eligibleForFRCreditScores[1];
            $secondProfile->save();

            $thirdProfile               = $profile->replicate();
            $thirdProfile->credit_score = $eligibleForFRCreditScores[2];
            $thirdProfile->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
