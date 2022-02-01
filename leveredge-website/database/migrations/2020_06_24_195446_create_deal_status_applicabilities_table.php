<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealStatusApplicabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_status_applicabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('deal_id');
            $table->unsignedBigInteger('deal_status_id');
            $table->unsignedBigInteger('sort_order')->default(99);

            $table->foreign('deal_id')->references('id')->on('deals')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('deal_status_id')->references('id')->on('deal_statuses')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('deal_status_applicabilities');
    }
}
