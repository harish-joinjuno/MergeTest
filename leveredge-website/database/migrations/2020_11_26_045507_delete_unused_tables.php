<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteUnusedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('affiliates');
        Schema::drop('battle_royal_contestants');
        Schema::drop('join_juno_migrations');
        Schema::drop('laurel_road_eligible_schools');
        Schema::drop('lead_page_views');
        Schema::drop('leads');
        Schema::drop('lender_products');
        Schema::drop('lenders');
        Schema::drop('live_wire_entries');
        Schema::drop('loan_amounts');
        Schema::drop('landing_page_views');
        Schema::drop('loan_terms');
        Schema::drop('mail_chimp_campaigns');
        Schema::drop('mailchimp_responses');
        Schema::dropIfExists('old_access_the_deals');
        Schema::drop('page_views');
        Schema::drop('products');
        Schema::drop('programs');
        Schema::drop('refinance_subscribers');
        Schema::drop('refinance_test_users');
        Schema::drop('school_vs_school_competition_entrants');
        Schema::drop('school_vs_school_competitions');
        Schema::drop('tuition_due_date_programs');
        Schema::drop('user_refi_flows');
        Schema::drop('user_flow_trackings');
        Schema::drop('wait_list_members');
        Schema::drop('repayment_plans');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
