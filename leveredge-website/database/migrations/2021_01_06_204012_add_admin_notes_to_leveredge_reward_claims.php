<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminNotesToLeveredgeRewardClaims extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leveredge_reward_claims', function (Blueprint $table) {
            $table->text('admin_notes')->after('properties')->nullable();
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
            $table->dropColumn('admin_notes');
        });
    }
}