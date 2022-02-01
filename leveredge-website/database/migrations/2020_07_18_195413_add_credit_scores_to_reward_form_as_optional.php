<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreditScoresToRewardFormAsOptional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leveredge_reward_claims', function (Blueprint $table) {
            $table->string('credit_score')->nullable();
            $table->string('cosigner_credit_score')->nullable();
            $table->integer('annual_income')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leveredge_reward_claims', function (Blueprint $table) {
            $table->dropColumn('credit_score');
            $table->dropColumn('cosigner_credit_score');
            $table->dropColumn('annual_income');
        });
    }
}
