<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResponseToMailchimpAutomatedCampaignUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mailchimp_automated_campaign_users', function (Blueprint $table) {
            $table->text('response')->nullable()->after('status');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mailchimp_automated_campaign_users', function (Blueprint $table) {
            $table->dropColumn('response');
            $table->dropSoftDeletes();
        });
    }
}
