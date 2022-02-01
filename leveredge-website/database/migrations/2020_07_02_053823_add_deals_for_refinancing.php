<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDealsForRefinancing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $originalEarnestDeal = \App\Deal::where('slug','earnest-refinance-2020')->first();
        \Illuminate\Support\Facades\DB::table('deals')->insert([
            [
                'id' => 9,
                'deal_type_id' => 4,
                'fee_type_id' => 2,
                'name' => 'Earnest Refinance Deal with Rewards',
                'slug' => \App\Deal::DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_SLUG,
                'start_date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'description' => 'This deal is for refinancing student loans with Earnest except in Michigan and Massachusetts',
                'reward_program' => "App\RewardPrograms\Concretes\EarnestRefinanceLoanRewardProgram",
                'redirect_url'  => $originalEarnestDeal->redirect_url,
                'tracked_query_parameter' => $originalEarnestDeal->tracked_query_parameter,
                'allow_guest_access' => 0,
                'percentage_of_loan_amount' => $originalEarnestDeal->percentage_of_loan_amount,
                'deal_sort_order' => 0

            ],
            [
                'id' => 10,
                'deal_type_id' => 4,
                'fee_type_id' => 2,
                'name' => 'Earnest Refinance Deal with Rewards in Other States',
                'slug' => \App\Deal::DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_OTHER_STATES_SLUG,
                'start_date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'description' => 'This deal is for refinancing student loans with Earnest in Michigan and Massachusetts',
                'reward_program' => "App\RewardPrograms\Concretes\EarnestRefinanceLoanRewardProgramInOtherStates",
                'redirect_url'  => $originalEarnestDeal->redirect_url,
                'tracked_query_parameter' => $originalEarnestDeal->tracked_query_parameter,
                'allow_guest_access' => 0,
                'percentage_of_loan_amount' => $originalEarnestDeal->percentage_of_loan_amount,
                'deal_sort_order' => 0
            ]
        ]);
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
