<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBarPrepToUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('bar_prep_location')->nullable();
            $table->string('bar_prep_deadline')->nullable();
            $table->string('bar_prep_payment_info')->nullable();
            $table->string('bar_prep_payment_employer_name')->nullable();
            $table->string('bar_prep_sign_up')->nullable();
            $table->string('bar_prep_deposit_amount')->nullable();
            $table->string('bar_prep_course')->nullable();
            $table->string('bar_prep_priority')->nullable();
            $table->string('bar_prep_company_preference')->nullable();
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
            $table->dropColumn('bar_prep_location');
            $table->dropColumn('bar_prep_deadline');
            $table->dropColumn('bar_prep_payment_info');
            $table->dropColumn('bar_prep_payment_employer_name');
            $table->dropColumn('bar_prep_sign_up');
            $table->dropColumn('bar_prep_deposit_amount');
            $table->dropColumn('bar_prep_course');
            $table->dropColumn('bar_prep_priority');
            $table->dropColumn('bar_prep_company_preference');
        });
    }
}
