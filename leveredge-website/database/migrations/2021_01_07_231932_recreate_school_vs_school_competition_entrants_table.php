<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateSchoolVsSchoolCompetitionEntrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_vs_school_competition_entrants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('school_vs_school_competition_id');
            $table->string('colloquial_slug');
            $table->string('first_name')->nullable();
            $table->string('email')->unique();
            $table->boolean('wants_to_host_party')->nullable();
            $table->string('recommended_location')->nullable();
            $table->boolean('verified');
            $table->string('verification_code');
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
        Schema::dropIfExists('school_vs_school_competition_entrants');
    }
}
