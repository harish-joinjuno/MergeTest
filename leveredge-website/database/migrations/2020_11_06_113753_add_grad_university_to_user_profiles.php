<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGradUniversityToUserProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->unsignedInteger('grad_university_country_id')->nullable();
            $table->unsignedInteger('university_country_id')->nullable();
            $table->string('employed')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('full_time_offer')->nullable();
            $table->integer('total_annual_compensation')->nullable();
            $table->integer('expected_annual_compensation')->nullable();
            $table->integer('other_yearly_income')->nullable();
            $table->date('employment_start_date')->nullable();
            $table->string('employment_location')->nullable();
            $table->integer('refinance_amount')->nullable();
            $table->string('lender_name')->nullable();
            $table->string('currency')->nullable();
            $table->string('collateralized_loan')->nullable();
            $table->string('have_ssn')->nullable();
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
            $table->dropColumn('grad_university_country_id');
            $table->dropColumn('university_country_id');
            $table->dropColumn('employed');
            $table->dropColumn('employer_name');
            $table->dropColumn('full_time_offer');
            $table->dropColumn('total_annual_compensation');
            $table->dropColumn('expected_annual_compensation');
            $table->dropColumn('other_yearly_income');
            $table->dropColumn('employment_start_date');
            $table->dropColumn('employment_location');
            $table->dropColumn('refinance_amount');
            $table->dropColumn('lender_name');
            $table->dropColumn('currency');
            $table->dropColumn('collateralized_loan');
            $table->dropColumn('have_ssn');
        });
    }
}
