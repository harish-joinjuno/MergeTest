<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppAndSignedDatesToAccessTheDeals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->date('applied_on')->nullable();
            $table->date('signed_on')->nullable();
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
            $table->dropColumn('applied_on');
            $table->dropColumn('signed_on');
        });
    }
}
