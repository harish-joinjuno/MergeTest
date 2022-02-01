<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailChimpCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_chimp_campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('campaign_id');
            $table->string('status');
            $table->string('subject_line');
            $table->string('title');
            $table->string('emails_sent');
            $table->string('send_time');
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
        Schema::dropIfExists('mail_chimp_campaigns');
    }
}
