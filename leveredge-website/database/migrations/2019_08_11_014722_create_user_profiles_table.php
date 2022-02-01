<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('immigration_status')->nullable();
            $table->string('application_status')->nullable();
            $table->integer('university_id')->nullable();
            $table->integer('degree_id')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->string('enrollment_status')->nullable();
            $table->string('degree_format')->nullable();
            $table->string('credit_score')->nullable();
            $table->string('cosigner_status')->nullable();
            $table->string('cosigner_credit_score')->nullable();
            $table->integer('annual_income')->nullable();
            $table->string('referral_code')->nullable();
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
        Schema::dropIfExists('user_profiles');
    }
}
