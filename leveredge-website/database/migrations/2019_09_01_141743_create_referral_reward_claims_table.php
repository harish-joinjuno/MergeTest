<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralRewardClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_reward_claims', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('reward');
            $table->integer('value');
            $table->string('address_line_one')->nullable();
            $table->string('address_line_two')->nullable();
            $table->string('address_line_three')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_reward_claims');
    }
}
