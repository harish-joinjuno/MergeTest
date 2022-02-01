<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionFlowValidationErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_flow_validation_errors', function (Blueprint $table) {
            $table->id();
            $table->morphs('memberable','qf_validation_memberable_index');
            $table->unsignedBigInteger('question_flow_id');
            $table->foreign('question_flow_id')->references('id')->on('question_flows')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('question_page_id');
            $table->foreign('question_page_id')->references('id')->on('question_pages')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->json('response');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_flow_validation_errors');
    }
}
