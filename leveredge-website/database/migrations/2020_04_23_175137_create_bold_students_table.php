<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoldStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bold_students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('street_address');
            $table->string('email');
            $table->string('phone_number');
            $table->string('citizenship');
            $table->string('credit_score');
            $table->string('education_degree_type');
            $table->string('education_school_name');
            $table->integer('education_expected_graduation_year');
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
        Schema::dropIfExists('bold_students');
    }
}
