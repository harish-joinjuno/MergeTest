<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_page_id')->constrained('question_pages')->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(99);
            $table->string('template')->nullable();
            $table->string('type');
            $table->string('label');
            $table->string('helper_text')->nullable();
            $table->string('tooltip')->nullable();
            $table->string('placeholder')->nullable();
            $table->string('field_name');
            $table->string('question_option')->nullable();
            $table->string('skip_policy')->nullable();
            $table->string('visibility_policy')->nullable();
            $table->string('validation_rules')->nullable();
            $table->string('persist_response');
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
        Schema::dropIfExists('questions');
    }
}
