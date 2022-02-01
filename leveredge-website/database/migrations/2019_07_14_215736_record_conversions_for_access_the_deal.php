<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecordConversionsForAccessTheDeal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->string('loan_status')->nullable();
        });

        $access_records = \App\AccessTheDeal::where('result','sent to laurel road')->get();

        foreach($access_records as $record){
            $record->loan_status = config('constant.laurel_road_loan_status.loan_approved');
            $record->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->dropColumn('loan_status');
        });
    }
}
