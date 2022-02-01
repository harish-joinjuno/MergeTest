<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailchimpListCampaignReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailchimp_list_campaign_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_id');
            $table->string('campaign_title');
            $table->string('type');
            $table->string('list_id');
            $table->boolean('list_is_active');
            $table->string('list_name');
            $table->string('subject_line');
            $table->string('preview_text');
            $table->unsignedInteger('emails_sent');
            $table->unsignedInteger('abuse_reports');
            $table->unsignedInteger('unsubscribed');
            $table->unsignedInteger('hard_bounces');
            $table->unsignedInteger('soft_bounces');
            $table->unsignedInteger('syntax_errors');
            $table->unsignedInteger('forwards_count');
            $table->unsignedInteger('forwards_opens');
            $table->unsignedInteger('opens_total');
            $table->unsignedInteger('unique_opens');
            $table->decimal('open_rate');
            $table->unsignedInteger('clicks_total');
            $table->unsignedInteger('unique_clicks');
            $table->unsignedInteger('unique_subscriber_clicks');
            $table->float('click_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailchimp_list_campaign_reports');
    }
}
