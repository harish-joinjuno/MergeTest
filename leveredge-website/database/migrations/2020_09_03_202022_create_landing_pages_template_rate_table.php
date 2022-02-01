<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPagesTemplateRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page_template_rate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('landing_page_template_id');
            $table->unsignedBigInteger('rate_id');
            $table->timestamps();

            $table->foreign('landing_page_template_id')->references('id')->on('landing_page_templates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('rate_id')->references('id')->on('rates')
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
        Schema::dropIfExists('landing_page_template_rate');
    }
}
