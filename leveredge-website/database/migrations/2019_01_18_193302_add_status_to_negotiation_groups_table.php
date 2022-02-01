<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToNegotiationGroupsTable extends Migration
{

    public function up()
    {
        Schema::table('negotiation_groups', function (Blueprint $table) {
            $table->string('status')->default('In Progress');
        });
    }

    public function down()
    {
        if (Schema::hasTable('negotiation_groups'))
            Schema::table('negotiation_groups', function (Blueprint $table) {
                $table->dropColumn('status');
            });
    }
}
