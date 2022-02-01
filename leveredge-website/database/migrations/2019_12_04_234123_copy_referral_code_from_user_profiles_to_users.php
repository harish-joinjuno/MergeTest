<?php

use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class CopyReferralCodeFromUserProfilesToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (DB::table('users')->get() as $user) {
            if (!$user->profile || !$user->profile->referral_code) {
                continue;
            }

            $user->referral_code = $user->profile->referral_code;
            $user->save();
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
