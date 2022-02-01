<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAffiliateToAccessTable extends Migration
{
    public function up()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->string('referred_by')->nullable();
        });
    }

    public function down()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            if (Schema::hasColumn('access_the_deals', 'referred_by'))
                $table->dropColumn('referred_by');
        });
    }
}
