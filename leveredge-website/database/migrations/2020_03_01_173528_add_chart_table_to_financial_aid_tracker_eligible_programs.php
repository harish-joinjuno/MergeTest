<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChartTableToFinancialAidTrackerEligiblePrograms extends Migration
{

    public function up()
    {
        Schema::table('financial_aid_tracker_eligible_programs', function (Blueprint $table) {
            $table->text('chart_label')->after('degree_id')->nullable();
            $table->dropColumn('average_reported_aid_amount');
        });
    }

    public function down()
    {
        Schema::table('financial_aid_tracker_eligible_programs', function (Blueprint $table) {
            $table->dropColumn('chart_label');
            $table->unsignedInteger('average_reported_aid_amount');
        });
    }
}
