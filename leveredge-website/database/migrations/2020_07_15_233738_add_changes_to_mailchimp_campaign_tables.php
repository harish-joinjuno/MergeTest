<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangesToMailchimpCampaignTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mailchimp_automated_campaigns', function (Blueprint $table) {
            $table->boolean('should_be_validated')->default(false)->after('endpoint');
        });

        Schema::table('mailchimp_automated_campaign_users', function (Blueprint $table) {
            $table->boolean('validated')->default(false)->after('send_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mailchimp_automated_campaigns', function (Blueprint $table) {
            $table->dropColumn('should_be_validated');
        });

        Schema::table('mailchimp_automated_campaign_users', function (Blueprint $table) {
            $table->dropColumn('validated');
        });
    }
}
