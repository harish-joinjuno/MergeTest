<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOriginalLoanTermToAutoRefinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auto_refinance_applications', function (Blueprint $table) {
            $table->unsignedInteger('original_loan_term_in_months')->nullable();
            $table->decimal('original_loan_interest_rate')->nullable();
            $table->unsignedInteger('original_loan_months_remaining')->nullable();
            $table->unsignedInteger('employment_length_in_years')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auto_refinance_applications', function (Blueprint $table) {
            $table->dropColumn('original_loan_term_in_months');
            $table->dropColumn('original_loan_interest_rate');
            $table->dropColumn('original_loan_months_remaining');
            $table->dropColumn('employment_length_in_years');
        });
    }
}
