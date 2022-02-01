<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoanAmountsToNegotiationGroupEligibleProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negotiation_group_eligible_profiles', function (Blueprint $table) {
            $table->integer('minimum_loan_amount')->nullable();
            $table->integer('maximum_loan_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('negotiation_group_eligible_profiles', function (Blueprint $table) {
            $table->dropColumn('minimum_loan_amount');
            $table->dropColumn('maximum_loan_amount');
        });
    }
}
