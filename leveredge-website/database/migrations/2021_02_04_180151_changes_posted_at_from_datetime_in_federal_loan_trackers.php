<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesPostedAtFromDatetimeInFederalLoanTrackers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('federal_loan_trackers', function (Blueprint $table) {
            $table->date('posted_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('federal_loan_trackers', function (Blueprint $table) {
            $table->dateTime('posted_at')->nullable()->change();
        });
    }
}
