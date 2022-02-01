<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAccessTheDealIdFromInternationalStudentHealthInsuranceClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('international_student_health_insurance_claims', function (Blueprint $table) {
            $table->dropForeign('health_insurance_access_the_deal_foreign');
            $table->dropColumn('access_the_deal_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('international_student_health_insurance_claims', function (Blueprint $table) {
            $table->unsignedInteger('access_the_deal_id');
            $table->foreign('access_the_deal_id', 'health_insurance_access_the_deal_foreign')->references('id')->on('access_the_deals')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }
}
