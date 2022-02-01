<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEndpointsColumnToMailchimpAutomatedCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mailchimp_automated_campaigns', function (Blueprint $table) {
            $table->text('endpoints')->after('should_be_validated')->nullable();
        });

        $mailchimpAutomatedCampaigns = \App\MailchimpAutomatedCampaign::all();

        foreach ($mailchimpAutomatedCampaigns as $mailchimpAutomatedCampaign) {
            $mailchimpAutomatedCampaign->endpoints = [$mailchimpAutomatedCampaign->endpoint];
            $mailchimpAutomatedCampaign->save();
        }

        Schema::table('mailchimp_automated_campaigns', function (Blueprint $table) {
            $table->dropColumn('endpoint');
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
            $table->string('endpoint');
        });

        $mailchimpAutomatedCampaigns = \App\MailchimpAutomatedCampaign::all();

        foreach ($mailchimpAutomatedCampaigns as $mailchimpAutomatedCampaign) {
            $mailchimpAutomatedCampaign->endpoint = $mailchimpAutomatedCampaign->endpoints[0];
            $mailchimpAutomatedCampaign->save();
        }

        Schema::table('mailchimp_automated_campaigns', function (Blueprint $table) {
            $table->dropColumn('endpoints');
        });
    }
}
