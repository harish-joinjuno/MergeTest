<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueAccessCodeAndViewTrackingToAffiliates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->string('access_code')->nullable();
            $table->integer('viewed_student_loan_deal')->default(0);
            $table->integer('viewed_refinance_deal')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->dropColumn('access_code');
            $table->dropColumn('viewed_student_loan_deal');
            $table->dropColumn('viewed_refinance_deal');
        });
    }
}
