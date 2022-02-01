<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTypeMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_type_metrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_type_id');
            $table->unsignedBigInteger('metric_id');
            $table->timestamps();

            $table->foreign('contract_type_id')->references('id')->on('contract_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('metric_id')->references('id')->on('metrics')
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
        Schema::dropIfExists('contract_type_metrics');
    }
}
