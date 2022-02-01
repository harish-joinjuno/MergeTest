<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCareerOneStopId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('career_one_stop_scholarships', function (Blueprint $table) {
            $table->unsignedInteger('career_one_stop_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('career_one_stop_scholarships', function (Blueprint $table) {
            $table->dropColumn('career_one_stop_id');
        });
    }
}
