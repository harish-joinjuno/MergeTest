<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilesToCampusAmbassadorTaskUserTable extends Migration
{
    public function up()
    {
        Schema::table('campus_ambassador_task_user', function (Blueprint $table) {
            $table->text('files')->nullable();
        });
    }

    public function down()
    {
        Schema::table('campus_ambassador_task_user', function (Blueprint $table) {
            $table->dropColumn('files');
        });
    }
}
