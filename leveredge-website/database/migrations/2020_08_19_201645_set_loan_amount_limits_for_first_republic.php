<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetLoanAmountLimitsForFirstRepublic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('negotiation_group_eligible_profiles')
            ->whereIn('negotiation_group_id',[14,16])
            ->update([
                'minimum_loan_amount' => 5000,
                'maximum_loan_amount' => 315000,
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table('negotiation_group_eligible_profiles')
            ->whereIn('negotiation_group_id',[14,16])
            ->update([
                'minimum_loan_amount' => null,
                'maximum_loan_amount' => null,
            ]);
    }
}
