<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ApproveAnyoneBeforeJulyTwentySixForLaurelRoad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach(\App\AccessTheDeal::where('result','sent to laurel road')->where('id','<',2993)->get() as $access_the_deal_record){
            $access_the_deal_record->loan_status = config( 'constant.laurel_road_loan_status.loan_approved' );
            $access_the_deal_record->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // This change cannot be reversed.
    }
}
