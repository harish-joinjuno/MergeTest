<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpringTwentyNineteenRefinanceSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spring_twenty_nineteen_refinance_surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('university')->nullable();
            $table->string('program')->nullable();
            $table->string('graduation_year')->nullable();
            $table->string('graduation_month')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('job_start_year')->nullable();
            $table->string('job_start_month')->nullable();
            $table->string('credit_score')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('loan_amount')->nullable();
            $table->string('cosigner_status')->nullable();
            $table->integer('user_id')->unique();
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
        Schema::dropIfExists('spring_twenty_nineteen_refinance_surveys');
    }
}
