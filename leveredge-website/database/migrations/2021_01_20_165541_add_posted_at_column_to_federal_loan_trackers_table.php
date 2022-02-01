<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostedAtColumnToFederalLoanTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('federal_loan_trackers', function (Blueprint $table) {
            $table->timestamp('posted_at')->nullable()->after('source');
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
            $table->dropColumn('posted_at');
        });
    }
}
