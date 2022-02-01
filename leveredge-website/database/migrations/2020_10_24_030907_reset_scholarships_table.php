<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ResetScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('scholarships');

        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scholarship_template_id')->constrained('scholarship_templates');
            $table->string('name');
            $table->string('slug')->unique();
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
        Schema::dropIfExists('scholarships');

        Schema::create('scholarships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('type');
            $table->string('university');
            $table->string('program');
            $table->string('graduation_year');
            $table->string('uni_and_program');
            $table->timestamps();
        });
    }
}
