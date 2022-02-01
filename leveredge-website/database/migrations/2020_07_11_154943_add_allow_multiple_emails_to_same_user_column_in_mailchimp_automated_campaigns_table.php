<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllowMultipleEmailsToSameUserColumnInMailchimpAutomatedCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mailchimp_automated_campaigns', function (Blueprint $table) {
            $table->boolean('allow_multiple_emails')->default(false);
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
            $table->dropColumn('allow_multiple_emails');
        });
    }
}
