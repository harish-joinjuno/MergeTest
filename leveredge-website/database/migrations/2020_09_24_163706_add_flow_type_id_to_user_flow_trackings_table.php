<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlowTypeIdToUserFlowTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_flow_trackings', function (Blueprint $table) {
            $table->integer('flow_type')->after('user_id')->nullable();
        });

        \Illuminate\Support\Facades\DB::table('user_flow_trackings')
            ->where('created_at', '>=', '2020-09-24')
            ->where('on_fast_flow', 1)
            ->orderBy('id')
            ->each(function ($userFlowTracking) {
                \Illuminate\Support\Facades\DB::table('user_flow_trackings')
                    ->where('id',$userFlowTracking->id)
                    ->update([
                    'flow_type' => 6,
                ]);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_flow_trackings', function (Blueprint $table) {
            $table->dropColumn('flow_type');
        });
    }
}
