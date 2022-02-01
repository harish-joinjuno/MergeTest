<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentMethodIdColumnToInternationalStudentHealthInsuranceClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('international_student_health_insurance_claims', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_method_id')->after('access_the_deal_id');
            $table->foreign('payment_method_id', 'payment_method_international_student_foreign')->references('id')
                ->on('payment_methods')->onUpdate('cascade')->onDelete('cascade');

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
            $table->dropForeign('payment_method_international_student_foreign');
            $table->dropColumn('payment_method_id');
        });
    }
}
