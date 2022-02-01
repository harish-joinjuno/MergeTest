<?php

use App\UserProfile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CopyDataFromAffiliatesTablesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (DB::table('users')->get() as $user) {
            // Copy the Referral Code, if the user exists in the Affiliate Database
            $affiliate = DB::table('affiliates')->where('email', $user->email)->first();
            if ($affiliate) {

                if (!$user->profile) {
                    $user_profile          = new UserProfile();
                    $user_profile->user_id = $user->id;
                    $user_profile->save();
                    $user = \App\User::where('id', $user->id)->first();
                }

                $user_profile                = $user->profile;
                $user_profile->referral_code = $affiliate->code;
                $user_profile->save();

                /*
                 * Referral
                 */
                if ($affiliate->referred_by_id) {
                    $referring_affiliate  = DB::table('affiliates')->find($affiliate->referred_by_id);
                    $referring_user       = \App\User::where('email', $referring_affiliate->email)->first();
                    $user->referred_by_id = $referring_user->id;
                    $user->save();
                }

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

    }
}
