<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConvertToTextField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('career_one_stop_scholarships', function (Blueprint $table) {
            $table->text('to_apply')->nullable()->change();
            $table->text('qualifications')->nullable()->change();
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
            $table->string('to_apply')->nullable()->change();
            $table->string('qualifications')->nullable()->change();
        });
    }
}
