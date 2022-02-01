<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralProgramEligibleProfilesTable extends Migration
{

    public function up()
    {
        Schema::create('referral_program_eligible_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('referral_program_id');
            $table->unsignedInteger('university_id')->nullable();
            $table->unsignedInteger('degree_id')->nullable();
            $table->unsignedInteger('grad_degree_id')->nullable();
            $table->unsignedInteger('grad_university_id')->nullable();
            $table->date('created_on_or_after')->nullable();
            $table->date('created_before')->nullable();
            $table->string('immigration_status', 128)->nullable();
            $table->foreign('referral_program_id')->references('id')->on('referral_programs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('referral_program_eligible_profiles');
    }
}
