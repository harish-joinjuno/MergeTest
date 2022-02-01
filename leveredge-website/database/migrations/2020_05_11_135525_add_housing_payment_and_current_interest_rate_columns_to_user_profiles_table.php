<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHousingPaymentAndCurrentInterestRateColumnsToUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->decimal('current_interest_rate', 4, 2)
                ->after('signup_progress')
                ->nullable();
            $table->unsignedInteger('housing_payment')
                ->after('signup_progress')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn(['housing_payment', 'current_interest_rate']);
        });
    }
}
