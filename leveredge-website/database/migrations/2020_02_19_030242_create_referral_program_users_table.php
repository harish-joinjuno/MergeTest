<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralProgramUsersTable extends Migration
{

    public function up()
    {
        Schema::create('referral_program_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('referral_program_id');
            $table->unsignedInteger('user_id');
            $table->date('starts_on');
            $table->date('ends_before')->nullable();
            $table->timestamps();
        });

         \Illuminate\Support\Facades\Artisan::call('db:seed --class=ReferralProgramsTableSeeder');
    }

    public function down()
    {
        Schema::dropIfExists('referral_program_users');
    }
}
