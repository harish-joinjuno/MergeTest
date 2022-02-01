<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolVsSchoolCompetitionsTable extends Migration
{

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

    public function down()
    {
        Schema::dropIfExists('school_vs_school_competitions');
    }
}
