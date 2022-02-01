<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventsToUserRefiFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_refi_flows', function (Blueprint $table) {
            $table->boolean('date_and_time_selected')->default(false);
            $table->boolean('event_scheduled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_refi_flows', function (Blueprint $table) {
            //
        });
    }
}
