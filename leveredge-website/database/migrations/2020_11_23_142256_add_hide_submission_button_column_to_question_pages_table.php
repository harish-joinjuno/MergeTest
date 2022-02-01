<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHideSubmissionButtonColumnToQuestionPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_pages', function (Blueprint $table) {
            $table->boolean('hide_submission_button')->after('skip_policy')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_pages', function (Blueprint $table) {
            $table->dropColumn('hide_submission_button');
        });
    }
}
