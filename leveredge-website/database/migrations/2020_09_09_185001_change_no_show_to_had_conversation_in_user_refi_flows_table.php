<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNoShowToHadConversationInUserRefiFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_refi_flows', function (Blueprint $table) {
            $table->renameColumn('no_show', 'had_conversation');
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
            $table->renameColumn('had_conversation', 'no_show');
        });
    }
}
