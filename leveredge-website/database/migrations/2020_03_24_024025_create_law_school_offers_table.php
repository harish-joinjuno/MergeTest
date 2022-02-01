<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawSchoolOffersTable extends Migration
{

    public function up()
    {
        Schema::create('law_school_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('program');
            $table->unsignedInteger('application_year')->nullable();
            $table->unsignedInteger('amount');
            $table->unsignedInteger('lsat_score');
            $table->decimal('gpa',4,2);
            $table->boolean('applied_early_decision')->nullable();
            $table->boolean('received_fee_waiver')->nullable();
            $table->string('state')->nullable();
            $table->string('race')->nullable();
            $table->string('sex')->nullable();
            $table->boolean('international')->nullable();
            $table->boolean('lgbt')->nullable();
            $table->boolean('teach_for_america')->nullable();
            $table->boolean('military')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('law_school_offers');
    }
}
