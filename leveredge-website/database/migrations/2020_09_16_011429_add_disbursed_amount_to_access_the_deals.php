<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisbursedAmountToAccessTheDeals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->unsignedBigInteger('disbursed_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->dropColumn('disbursed_amount');
        });
    }
}
