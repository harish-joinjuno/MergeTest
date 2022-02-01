<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRepaymentPlanColumnToDisclosureDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disclosure_details', function (Blueprint $table) {
            $table->string('repayment_plan')->after('right_to_cancel_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('disclosure_details', function (Blueprint $table) {
            $table->dropColumn('repayment_plan');
        });
    }
}