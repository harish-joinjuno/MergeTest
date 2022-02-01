<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletedToLeveredgeRewardClaimsAndDistributions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leveredge_reward_claims', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('leveredge_reward_distributions', function (Blueprint $table) {
            $table->softDeletes();
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
            $table->dropSoftDeletes();
        });

        Schema::table('leveredge_reward_distributions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
