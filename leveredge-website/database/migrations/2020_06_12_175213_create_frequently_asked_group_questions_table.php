<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequentlyAskedGroupQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequently_asked_group_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faq_group_id');
            $table->unsignedBigInteger('faq_id');

            $table->foreign('faq_group_id')->references('id')->on('faq_groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('faq_id')->references('id')->on('faqs')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('frequently_asked_group_questions');
    }
}
