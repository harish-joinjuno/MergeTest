<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyticsSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analytics_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Illuminate\Support\Facades\DB::table('analytics_sources')->insert([
             ['name' => 'Paid - Google'],
             ['name' => 'Paid - Facebook'],
             ['name' => 'Paid - Other'],
             ['name' => 'Social'],
             ['name' => 'Partnerships'],
             ['name' => 'Referral'],
             ['name' => 'Other'],
             ['name' => 'Unknown'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analytics_sources');
    }
}
