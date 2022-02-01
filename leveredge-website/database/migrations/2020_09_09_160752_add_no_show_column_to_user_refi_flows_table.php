<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoShowColumnToUserRefiFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_refi_flows', function (Blueprint $table) {
            $table->boolean('no_show')->after('flow_type')->nullable();
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
            $table->dropColumn('no_show');
        });
    }
}
