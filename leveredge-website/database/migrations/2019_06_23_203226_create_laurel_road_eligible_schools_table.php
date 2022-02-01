<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaurelRoadEligibleSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laurel_road_eligible_schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('university');
            $table->boolean('dental');
            $table->boolean('law');
            $table->boolean('business');
            $table->boolean('engineering');
            $table->boolean('nursingma');
            $table->boolean('nursingdnp');
            $table->boolean('physicians_assistant');
            $table->boolean('medicine');
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
        Schema::dropIfExists('laurel_road_eligible_schools');
    }
}
