<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerOneStopScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_one_stop_scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('organization')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('level_of_study')->nullable();
            $table->string('award_type')->nullable();
            $table->string('purpose')->nullable();
            $table->string('focus')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('criteria')->nullable();
            $table->string('funds')->nullable();
            $table->string('duration')->nullable();
            $table->string('number_of_awards')->nullable();
            $table->string('to_apply')->nullable();
            $table->string('deadline')->nullable();
            $table->string('contact')->nullable();
            $table->string('for_more_information')->nullable();
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
        Schema::dropIfExists('career_one_stop_scholarships');
    }
}
