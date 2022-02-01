<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportedApplicationAndSignedColumnsToAccessTheDeals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->boolean('reported_application_to_facebook')->default(0);
            $table->boolean('reported_signature_to_facebook')->default(0);
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
            $table->dropColumn('reported_application_to_facebook');
            $table->dropColumn('reported_signature_to_facebook');
        });
    }
}
