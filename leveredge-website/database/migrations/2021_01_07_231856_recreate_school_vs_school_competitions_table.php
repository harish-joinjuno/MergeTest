<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateSchoolVsSchoolCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_vs_school_competitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('university_id_one');
            $table->unsignedInteger('degree_id_one');
            $table->string('colloquial_name_one');
            $table->unsignedInteger('class_size_one');
            $table->unsignedInteger('university_id_two');
            $table->unsignedInteger('degree_id_two');
            $table->string('colloquial_name_two');
            $table->unsignedInteger('class_size_two');
            $table->unsignedInteger('first_prize_amount');
            $table->unsignedInteger('second_prize_amount')->nullable();
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
        Schema::dropIfExists('school_vs_school_competitions');
    }
}
