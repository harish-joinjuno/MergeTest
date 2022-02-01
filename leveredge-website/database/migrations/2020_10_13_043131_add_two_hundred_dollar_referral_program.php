<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoHundredDollarReferralProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('referral_programs')->insert([
            [
                'name'         => 'One Sided Two Hundred Dollars',
                'display_name' => '$200 per loan above $20K',
                'slug'         => \App\ReferralProgram::REFERRAL_PROGRAM_TWO_HUNDRED_PER_LOAN_ABOVE_20K,
                'priority'     => 4,
                'created_at'   => now()->format('Y-m-d h:i:s'),
                'updated_at'   => now()->format('Y-m-d h:i:s'),
            ],
        ]);
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
