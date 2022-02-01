<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySchoolVsSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_vs_school_competitions', function (Blueprint $table) {
            $table->dropColumn('degree_id_one');
            $table->dropColumn('degree_id_two');
            $table->dropColumn('class_size_one');
            $table->dropColumn('class_size_two');
            $table->dropColumn('second_prize_amount');
            $table->integer('target_number_of_students');
            $table->integer('number_of_prizes');
            $table->string('hero_image');
            $table->string('logo_one');
            $table->string('logo_two');
            $table->text('true_statements')->nullable();
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
            $table->unsignedInteger('degree_id_one');
            $table->unsignedInteger('degree_id_two');
            $table->unsignedInteger('class_size_one');
            $table->unsignedInteger('class_size_two');
            $table->unsignedInteger('second_prize_amount')->nullable();
            $table->dropColumn(['target_number_of_students','number_of_prizes','hero_image','logo_one','logo_two','true_statements']);
        });
    }
}
