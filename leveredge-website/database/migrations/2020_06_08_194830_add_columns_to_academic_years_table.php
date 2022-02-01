<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAcademicYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('academic_years', function (Blueprint $table) {
            $table->string('display_name')
                ->nullable()
                ->after('ends_on');
            $table->text('dashboard_update')
                ->nullable()
                ->after('ends_on');
            $table->tinyInteger('display_count_based_on')
                ->default(1)
                ->after('ends_on');
            $table->text('progress_titles')
                ->nullable()
                ->after('ends_on');
            $table->text('progress_descriptions')
                ->nullable()
                ->after('ends_on');
            $table->tinyInteger('progress_stage')
                ->default(2)
                ->after('ends_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('academic_years', function (Blueprint $table) {
            $table->dropColumn([
                'display_name',
                'dashboard_update',
                'display_count_based_on',
                'progress_titles',
                'progress_descriptions',
                'progress_stage',
            ]);
        });
    }
}
