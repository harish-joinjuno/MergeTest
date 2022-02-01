<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarYearCarMakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_year_car_makes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_year_id')->constrained('car_years');
            $table->foreignId('car_make_id')->constrained('car_makes');
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
        Schema::dropIfExists('car_year_car_makes');
    }
}
