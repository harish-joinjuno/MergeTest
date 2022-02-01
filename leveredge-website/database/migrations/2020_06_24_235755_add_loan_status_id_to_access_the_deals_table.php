<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoanStatusIdToAccessTheDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->unsignedBigInteger('loan_status_id')->nullable();

            $table->foreign('loan_status_id')->references('id')->on('deal_statuses')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        \App\AccessTheDeal::all()
            ->each(function ($accessTheDeal) {
                if ($accessTheDeal->loan_status === 'LoanApproved') {
                    $accessTheDeal->loan_status_id = \App\DealStatus::SIGNED_THE_LOAN; //Signed the Loan
                    $accessTheDeal->loan_status = 'Signed the Loan';
                    $accessTheDeal->save();
                }
                if ($accessTheDeal->loan_status === null) {
                    $accessTheDeal->loan_status_id = \App\DealStatus::CLICKED_TO_PROVIDER_ID; //Clicked to Provider
                    $accessTheDeal->loan_status = 'Clicked to Provider';
                    $accessTheDeal->save();
                }

            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\AccessTheDeal::all()
            ->each(function ($accessTheDeal) {
                if ($accessTheDeal->loan_status_id === 8) {
                    $accessTheDeal->loan_status = 'LoanApproved';
                    $accessTheDeal->save();
                }
                if ($accessTheDeal->loan_status_id === 1) {
                    $accessTheDeal->loan_status = null;
                    $accessTheDeal->save();
                }

            });
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->dropForeign('access_the_deals_loan_status_id_foreign');
            $table->dropColumn('loan_status_id');
        });
    }
}
