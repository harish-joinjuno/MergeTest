<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_flow_id')->constrained('question_flows')->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(99);
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('template')->nullable();
            $table->string('skip_policy')->nullable();
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
        Schema::dropIfExists('question_pages');
    }
}
