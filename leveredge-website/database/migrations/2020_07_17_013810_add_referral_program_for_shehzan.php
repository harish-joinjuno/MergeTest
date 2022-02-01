<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferralProgramForShehzan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('referral_programs')
            ->where(['slug' => \App\ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_MILESTONE_PRIZES])
            ->update(['priority' => 2]);

        \Illuminate\Support\Facades\DB::table('referral_programs')
            ->where(['slug' => \App\ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_SCHOLARSHIP_POT])
            ->update(['priority' => 3]);

        \Illuminate\Support\Facades\DB::table('referral_programs')->insert([
            'name' => 'Quarter percent of first loan',
            'slug' => \App\ReferralProgram::REFERRAL_PROGRAM_QUARTER_PERCENT_OF_FIRST_LOAN,
            'display_name' => 'Quarter percent of first loan',
            'priority' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table('referral_programs')
            ->where(['slug' => \App\ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_MILESTONE_PRIZES])
            ->update(['priority' => 1]);

        \Illuminate\Support\Facades\DB::table('referral_programs')
            ->where(['slug' => \App\ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_SCHOLARSHIP_POT])
            ->update(['priority' => 2]);

        \Illuminate\Support\Facades\DB::table('referral_programs')
            ->where(['slug' => \App\ReferralProgram::REFERRAL_PROGRAM_QUARTER_PERCENT_OF_FIRST_LOAN,])
            ->delete();
    }
}
