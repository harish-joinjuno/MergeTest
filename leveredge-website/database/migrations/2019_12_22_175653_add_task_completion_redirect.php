<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaskCompletionRedirect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campus_ambassador_tasks', function (Blueprint $table) {
            $table->string('task_completion_redirect')->nullable();
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
            $table->dropColumn('task_completion_redirect');
        });
    }
}
