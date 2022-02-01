<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLaurelRoadDeal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('deals')->insert([
            'id'                        => 14,
            'deal_type_id'              => 4,
            'fee_type_id'               => 2,
            'name'                      => 'Laurel Road Refinance Deal',
            'description'               => 'This deal is for refinancing student loans for medical professionals',
            'start_date'                => now(),
            'end_date'                  => null,
            'redirect_url'              => 'https://www.laurelroad.com/partnerships/leveredge/',
            'tracked_query_parameter'   => 'leveredgeId',
            'allow_guest_access'        => 1,
            'fee_amount'                => null,
            'percentage_of_loan_amount' => '0.85%',
            'slug'                      => \App\Deal::DEAL_LAUREL_ROAD_REFINANCE_SLUG,
            'deal_sort_order'           => 4,
            'reward_program'            => null,
            'created_at'                => now(),
            'updated_at'                => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table('deals')
            ->where('slug',\App\Deal::DEAL_LAUREL_ROAD_REFINANCE_SLUG)
            ->delete();
    }
}
