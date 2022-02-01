<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColloquialSlugToNullableInschoolVsSchoolCompetitionEntrants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_vs_school_competition_entrants', function (Blueprint $table) {
            $table->string('colloquial_slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_vs_school_competition_entrants', function (Blueprint $table) {
            $table->string('colloquial_slug')->change();
        });
    }
}
