<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveMembersToMilestoneReferralProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('referral_program_users')
            ->where('referral_program_id',2)
            ->update([
                'referral_program_id' => 1,
            ]);

        $scholarshipEligibility = \App\ReferralProgramEligibleProfile::find(2);
        if ($scholarshipEligibility) {
            $scholarshipEligibility->created_before = now();
            $scholarshipEligibility->save();
        }

        $expandedMilestoneEligibility                 = \App\ReferralProgramEligibleProfile::find(1);
        $expandedMilestoneEligibility->grad_degree_id = null;
        $expandedMilestoneEligibility->save();
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
