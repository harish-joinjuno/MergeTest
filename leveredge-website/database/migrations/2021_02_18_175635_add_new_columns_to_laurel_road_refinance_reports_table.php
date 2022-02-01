<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToLaurelRoadRefinanceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laurel_road_refinance_reports', function (Blueprint $table) {
            $table->string('amount_to_refinance')->nullable();
            $table->string('graduation_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laurel_road_refinance_reports', function (Blueprint $table) {
            $table->dropColumn([
                'amount_to_refinance',
                'graduation_year',
            ]);
        });
    }
}
