<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConvertMoreFieldsToTextArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('career_one_stop_scholarships', function (Blueprint $table) {
            $table->text('organization')->nullable()->change();
            $table->text('level_of_study')->nullable()->change();
            $table->text('award_type')->nullable()->change();
            $table->text('focus')->nullable()->change();
            $table->text('criteria')->nullable()->change();
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
            $table->string('organization')->nullable()->change();
            $table->string('level_of_study')->nullable()->change();
            $table->string('award_type')->nullable()->change();
            $table->string('focus')->nullable()->change();
            $table->string('criteria')->nullable()->change();
        });
    }
}
