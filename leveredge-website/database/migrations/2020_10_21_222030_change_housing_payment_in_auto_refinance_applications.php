<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHousingPaymentInAutoRefinanceApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auto_refinance_applications', function (Blueprint $table) {
            $table->dropColumn('housing_payment');
        });
        Schema::table('auto_refinance_applications', function (Blueprint $table) {
            $table->string('housing_payment')->nullable()->after('stay_duration');
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
            //
        });
    }
}
