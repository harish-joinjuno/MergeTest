<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_years', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('year');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('car_years')->insert([
            ['year' => 2007],
            ['year' => 2008],
            ['year' => 2009],
            ['year' => 2010],
            ['year' => 2011],
            ['year' => 2012],
            ['year' => 2013],
            ['year' => 2014],
            ['year' => 2015],
            ['year' => 2016],
            ['year' => 2017],
            ['year' => 2018],
            ['year' => 2019],
            ['year' => 2020],
            ['year' => 2021],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_years');
    }
}
