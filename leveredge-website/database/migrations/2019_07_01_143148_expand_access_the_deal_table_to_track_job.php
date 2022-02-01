<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExpandAccessTheDealTableToTrackJob extends Migration
{
    public function up()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->boolean('job_queued')->default(0);
        });
    }

    public function down()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            if (Schema::hasColumn('access_the_deals', 'job_queued'))
                $table->dropColumn('job_queued');
        });
    }
}
