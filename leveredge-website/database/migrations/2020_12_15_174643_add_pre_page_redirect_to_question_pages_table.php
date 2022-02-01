<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrePageRedirectToQuestionPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_pages', function (Blueprint $table) {
            $table->string('pre_render_redirect')->after('hide_submission_button')->nullable();
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
            $table->dropColumn('pre_render_redirect');
        });
    }
}
