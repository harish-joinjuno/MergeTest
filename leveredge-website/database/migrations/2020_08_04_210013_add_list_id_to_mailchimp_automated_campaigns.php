<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddListIdToMailchimpAutomatedCampaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mailchimp_automated_campaigns', function (Blueprint $table) {
            $table->string('list_id')->after('endpoints')->default('26e8cb5982');
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
            $table->dropColumn('list_id');
        });
    }
}
