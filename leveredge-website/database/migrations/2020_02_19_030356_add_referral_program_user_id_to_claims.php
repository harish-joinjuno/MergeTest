<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddReferralProgramUserIdToClaims extends Migration
{

    public function up()
    {
        Schema::table('referral_reward_claims', function (Blueprint $table) {
            $table
                ->unsignedInteger('referral_program_user_id')
                ->nullable()
                ->after('id');
        });

        $referralRewardClaims = DB::table('referral_reward_claims')->get();
        foreach ($referralRewardClaims as $referralRewardClaim) {
            $referralProgramUser = DB::table('referral_program_users')
                ->where('user_id', $referralRewardClaim->user_id)
                ->first();

            $referralRewardClaim->referral_program_user_id = $referralProgramUser->id;

            DB::table('referral_reward_claims')
                ->where('id', '=', $referralRewardClaim->id)
                ->update([
                    'referral_program_user_id' => $referralProgramUser->id,
                ]);
        }

        Schema::table('referral_reward_claims', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->change();
            $table->unsignedInteger('referral_program_user_id')
                ->nullable(false)
                ->change();
        });
    }

    public function down()
    {
        Schema::table('referral_reward_claims', function (Blueprint $table) {
            $table->dropColumn('referral_program_user_id');
        });
    }
}
