<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsInPageNotFoundErrorsFromStringToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_not_found_errors', function (Blueprint $table) {
            $table->text('url')->change();
            $table->text('referer')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_not_found_errors', function (Blueprint $table) {
            $table->string('url')->change();
            $table->string('referer')->change();
        });
    }
}
