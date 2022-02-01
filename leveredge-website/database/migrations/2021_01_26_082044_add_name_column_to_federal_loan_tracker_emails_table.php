<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameColumnToFederalLoanTrackerEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('federal_loan_tracker_emails', function (Blueprint $table) {
            $table->string('name')->after('email')->nullable();
            $table->unsignedBigInteger('client_id')->after('email')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('federal_loan_tracker_emails', function (Blueprint $table) {
            $table->dropForeign('federal_loan_tracker_emails_client_id_foreign');
            $table->dropColumn('client_id', 'name');
        });
    }
}
