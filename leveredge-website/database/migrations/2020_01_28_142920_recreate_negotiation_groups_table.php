<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateNegotiationGroupsTable extends Migration
{

    public function up()
    {
        Schema::create('negotiation_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('academic_year_id');
            $table->string('name', 64);
            $table->string('slug', 128);
            $table->integer('priority');
            $table->integer('deal_confidence')->comment('An integer from 0 - 100, indicating the percentage');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('academic_year_id', 'academic_year_foreign')->references('id')->on('academic_years')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('negotiation_groups');
    }
}
