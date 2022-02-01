<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleAdMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_ad_metrics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('campaign_name');
            $table->string('campaign_id');
            $table->string('ad_group_name');
            $table->string('ad_group_id');
            $table->string('ad_group_criterion_id');
            $table->string('ad_group_criterion_keyword_text');
            $table->integer('ad_group_criterion_keyword_match_type');
            $table->integer('impressions');
            $table->integer('clicks');
            $table->decimal('cost');
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
        Schema::dropIfExists('google_ad_metrics');
    }
}
