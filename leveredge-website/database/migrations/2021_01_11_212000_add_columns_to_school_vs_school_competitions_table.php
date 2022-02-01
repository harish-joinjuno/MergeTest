<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSchoolVsSchoolCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_vs_school_competitions', function (Blueprint $table) {
            $table->string('color_one')->nullable();
            $table->string('color_two')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_vs_school_competitions', function (Blueprint $table) {
            $table->dropColumn([
                'color_one',
                'color_two'
            ]);
        });
    }
}
