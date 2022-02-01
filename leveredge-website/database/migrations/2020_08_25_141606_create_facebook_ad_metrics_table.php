<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacebookAdMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facebook_ad_metrics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('campaign_name');
            $table->string('campaign_id');
            $table->string('ad_set_name');
            $table->string('ad_set_id');
            $table->string('ad_name');
            $table->string('ad_id');
            $table->unsignedInteger('unique_clicks');
            $table->unsignedInteger('impressions');
            $table->unsignedInteger('reach');
            $table->decimal('frequency',8,2);
            $table->decimal('cost',12,2);
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
        Schema::dropIfExists('facebook_ad_metrics');
    }
}
