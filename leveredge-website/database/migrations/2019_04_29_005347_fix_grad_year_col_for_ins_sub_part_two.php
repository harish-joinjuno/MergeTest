<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixGradYearColForInsSubPartTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inschool_subscribers', function (Blueprint $table) {
            $table->integer('grad_year')->nullable();
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
            $table->dropColumn('grad_year');
        });
    }
}
