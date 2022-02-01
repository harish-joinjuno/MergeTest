<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrackingAndTaskTypesToCampusAmbassadorTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campus_ambassador_tasks', function (Blueprint $table) {
            $table->integer('task_recurrence');
            $table->integer('task_completion_tracking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campus_ambassador_tasks', function (Blueprint $table) {
            $table->dropColumn('task_recurrence');
            $table->dropColumn('task_completion_tracking');
        });
    }
}
