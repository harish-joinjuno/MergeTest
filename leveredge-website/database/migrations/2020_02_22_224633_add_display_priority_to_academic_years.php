<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDisplayPriorityToAcademicYears extends Migration
{

    public function up()
    {
        Schema::table('academic_years', function (Blueprint $table) {
            $table->unsignedInteger('display_priority')->default(99);
        });

        DB::statement('UPDATE academic_years SET display_priority = id');
    }

    public function down()
    {
        Schema::table('academic_years', function (Blueprint $table) {
            $table->dropColumn('display_priority');
        });
    }
}
