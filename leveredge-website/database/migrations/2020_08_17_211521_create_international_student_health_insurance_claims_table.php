<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternationalStudentHealthInsuranceClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('international_student_health_insurance_claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('payment_record_id')->nullable();
            $table->unsignedInteger('deal_id');
            $table->unsignedInteger('access_the_deal_id');
            $table->unsignedInteger('loan_amount');
            $table->boolean('payment_completed')->default(false);
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('deal_id')->references('id')->on('deals')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('access_the_deal_id', 'health_insurance_access_the_deal_foreign')->references('id')->on('access_the_deals')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('international_student_health_insurance_claims');
    }
}
