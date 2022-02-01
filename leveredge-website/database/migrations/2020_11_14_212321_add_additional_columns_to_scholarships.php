<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsToScholarships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scholarship_entrants', function (Blueprint $table) {
            $table->unsignedInteger('university_id')->after('email')->nullable();
            $table->unsignedInteger('degree_id')->after('university_id')->nullable();
            $table->unsignedInteger('graduation_year')->after('degree_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scholarship_entrants', function (Blueprint $table) {
            $table->dropColumn('university_id');
            $table->dropColumn('degree_id');
            $table->dropColumn('graduation_year');
        });
    }
}
