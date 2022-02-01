<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAdditionalFieldsToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('career_one_stop_scholarships', function (Blueprint $table) {
            $table->text('contact')->nullable()->change();
            $table->text('purpose')->nullable()->change();
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
            $table->string('contact')->nullable()->change();
            $table->string('purpose')->nullable()->change();
        });
    }
}
