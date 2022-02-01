<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailchimpAutomatedCampaignMailablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailchimp_automated_campaign_mailables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mailchimp_automated_campaign_id');
            $table->foreign('mailchimp_automated_campaign_id','mac_foreign_id')->references('id')->on('mailchimp_automated_campaigns')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->morphs('mailable', 'mac_mailable_type_mailable_id_index');
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
        Schema::dropIfExists('mailchimp_automated_campaign_mailables');
    }
}
