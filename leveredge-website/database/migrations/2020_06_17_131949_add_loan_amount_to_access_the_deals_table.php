<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoanAmountToAccessTheDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->unsignedInteger('loan_amount')->nullable();
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
            $table->dropColumn('loan_amount');
        });
    }
}
