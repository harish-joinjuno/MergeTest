<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToQuestionFlowRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('question_flows', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('question_pages', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('question_flows', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('question_pages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
