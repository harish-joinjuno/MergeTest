<?php

use App\Deal;
use App\DealType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInternationalStudentHealthInsuranceRewards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $dealType       = new DealType();
        $dealType->id   = DealType::INTERNATIONAL_STUDENT_HEALTH_INSURANCE;
        $dealType->name = 'International Student Health Insurance';
        $dealType->save();

        $deal                            = new Deal();
        $deal->id                        = Deal::orderBy('id','desc')->first()->id + 1;
        $deal->deal_type_id              = DealType::INTERNATIONAL_STUDENT_HEALTH_INSURANCE;
        $deal->fee_type_id               = 2;
        $deal->name                      = 'GBG Student Health Insurance';
        $deal->description               = 'This Deal is for international students looking for more affordable health insurance options';
        $deal->start_date                = now();
        $deal->end_date                  = null;
        $deal->redirect_url              = 'https://leveredge.org';
        $deal->tracked_query_parameter   = 'click_id';
        $deal->allow_guest_access        = 0;
        $deal->percentage_of_loan_amount = '20%';
        $deal->slug                      = Deal::DEAL_INTERNATIONAL_HEALTH_INSURANCE_20;
        $deal->reward_program            = null;
        $deal->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
