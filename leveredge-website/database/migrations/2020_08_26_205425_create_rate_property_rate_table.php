<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatePropertyRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_property_rate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rate_id');
            $table->unsignedBigInteger('rate_property_id');
            $table->timestamps();

            $table->foreign('rate_id')->references('id')->on('rates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('rate_property_id')->references('id')->on('rate_properties')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rate_property_rate');
    }
}
