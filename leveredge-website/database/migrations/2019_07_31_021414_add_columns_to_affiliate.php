<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToAffiliate extends Migration
{
    public function up()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->string('i_am')->nullable();
            $table->string('type')->nullable();
            $table->integer('graduation_year')->nullable();
        });
    }

    public function down()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->dropColumn('i_am');
            $table->dropColumn('type');
            $table->dropColumn('graduation_year');
        });
    }
}
