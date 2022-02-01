<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddReferredByUserTypeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analytics_source_rules', function (Blueprint $table) {
            $table->boolean('referred_by_user_is_partner')->nullable();
            $table->boolean('referred_by_user_is_member')->nullable();
        });

        $analyticsSourceRule                             = \App\AnalyticsSourceRule::where('referred_by_id_exists',true)->first();
        $analyticsSourceRule->referred_by_user_is_member = true;
        $analyticsSourceRule->save();

        \App\AnalyticsSourceRule::insert([
            'referred_by_id_exists'          => true,
            'referred_by_user_is_partner'    => 1,
            'analytics_source_id'            => 5,
            'sort_order'                     => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analytics_source_rules', function (Blueprint $table) {
            $table->dropColumn('referred_by_user_is_partner');
            $table->dropColumn('referred_by_user_is_member');
        });
    }
}
