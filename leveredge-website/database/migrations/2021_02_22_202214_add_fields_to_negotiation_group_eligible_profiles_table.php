<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToNegotiationGroupEligibleProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negotiation_group_eligible_profiles', function (Blueprint $table) {
            $table->decimal('original_loan_interest_rate')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->string('payoff_amount_below')->nullable();
            $table->string('income_below')->nullable();
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
            $table->dropColumn([
                'original_loan_interest_rate',
                'vehicle_year',
                'payoff_amount_below',
                'income_below',
            ]);
        });
    }
}
