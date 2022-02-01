<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixGradYearColForInsSub extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inschool_subscribers', function (Blueprint $table) {
            $table->dropColumn('graduation_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inschool_subscribers', function (Blueprint $table) {
            $table->timestamp('graduation_year')->nullable();
        });
    }
}
