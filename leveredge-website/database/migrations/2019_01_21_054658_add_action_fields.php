<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActionFields extends Migration
{
    public function up()
    {
        Schema::table('actions', function (Blueprint $table) {

            $table->string('icon_class');
            $table->string('completed_icon_class');
            $table->string('description');
            $table->string('completed_description');
            $table->string('call_to_action');
            $table->string('completed_call_to_action');

        });
    }

    public function down()
    {
        if (Schema::hasTable('actions'))
            Schema::table('actions', function (Blueprint $table) {

                $table->dropColumn('icon_class');
                $table->dropColumn('completed_icon_class');
                $table->dropColumn('description');
                $table->dropColumn('completed_description');
                $table->dropColumn('call_to_action');
                $table->dropColumn('completed_call_to_action');

            });
    }
}
