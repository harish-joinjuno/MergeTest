<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFirstRepublicToDeals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('deals', function (Blueprint $table) {
            $table->string('redirect_url',500)->change();
        });

        \Illuminate\Support\Facades\DB::table('deals')->insert([
            'id'                        => 12,
            'deal_type_id'              => 4,
            'fee_type_id'               => 1,
            'name'                      => 'First Republic Personal Line of Credit',
            'description'               => 'This deal is for refinancing student loans or other loans using a personal line of credit',
            'start_date'                => now(),
            'end_date'                  => null,
            'redirect_url'              => 'https://www.firstrepublic.com/personal-line-of-credit/calculator?ref=U&extole_advocate_code=LeverEdge&extole_shareable_id=6847790614364777567&RMF=&RML=&RME=&extole_zone_name=friend_landing_experience&extole_campaign_id=6668372534564326053&extole_share_channel=SHARE_LINK&extole_zone_name=friend_landing_experience',
            'tracked_query_parameter'   => 'leveredgeId',
            'allow_guest_access'        => 1,
            'fee_amount'                => 1000,
            'percentage_of_loan_amount' => null,
            'slug'                      => \App\Deal::DEAL_FIRST_REPUBLIC_PLOC_SLUG,
            'deal_sort_order'           => 2,
            'reward_program'            => 'App\RewardPrograms\Concretes\FirstRepublicRewardProgram',
            'created_at'                => now(),
            'updated_at'                => now(),
        ]);


        \Illuminate\Support\Facades\DB::table('deals')->insert([
            'id'                        => 13,
            'deal_type_id'              => 4,
            'fee_type_id'               => 2,
            'name'                      => 'Splash Refinance Deal',
            'description'               => 'This deal is for refinancing student loans',
            'start_date'                => now(),
            'end_date'                  => null,
            'redirect_url'              => 'https://splash-financial.j48ltb.net/c/2441308/873408/9516?utm_source=leveredge',
            'tracked_query_parameter'   => 'sharedid',
            'allow_guest_access'        => 1,
            'fee_amount'                => null,
            'percentage_of_loan_amount' => '0.85%',
            'slug'                      => \App\Deal::DEAL_SPLASH_REFINANCE_SLUG,
            'deal_sort_order'           => 3,
            'reward_program'            => 'App\RewardPrograms\Concretes\SplashRewardProgram',
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
            ->where('slug',\App\Deal::DEAL_FIRST_REPUBLIC_PLOC_SLUG)
            ->delete();

        \Illuminate\Support\Facades\DB::table('deals')
            ->where('slug',\App\Deal::DEAL_SPLASH_REFINANCE_SLUG)
            ->delete();
    }
}
