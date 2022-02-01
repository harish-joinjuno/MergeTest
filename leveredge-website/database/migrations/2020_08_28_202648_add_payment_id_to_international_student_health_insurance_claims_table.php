<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentIdToInternationalStudentHealthInsuranceClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('international_student_health_insurance_claims', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id')->after('deal_id')->nullable();
            $table->foreign('payment_id', 'international_claims_payment_id_foreign')->references('id')
                ->on('payments')->onUpdate('restrict')->onDelete('restrict');
            $table->dropColumn('payment_record_id');
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
            $table->dropForeign('international_claims_payment_id_foreign');
            $table->dropColumn('payment_id');
            $table->unsignedInteger('payment_record_id');
        });
    }
}
