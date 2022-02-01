<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTuitionAndProgramNamesDataToLaurelRoad extends Migration
{
    public function up()
    {
        Schema::table('laurel_road_eligible_schools', function (Blueprint $table) {

        });
    }

    public function down()
    {
        Schema::table('laurel_road_eligible_schools', function (Blueprint $table) {
            $table->dropColumn('law_program_name');
            $table->dropColumn('law_tuition_due_date');
            $table->dropColumn('business_program_name');
            $table->dropColumn('business_tuition_due_date');
        });

        Schema::table('laurel_road_eligible_schools', function (Blueprint $table) {
            $table->string('law_program_name')->nullable();
            $table->string('business_program_name')->nullable();
            $table->timestamp('law_tuition_due_date')->nullable();
            $table->timestamp('business_tuition_due_date')->nullable();
        });
    }
}
