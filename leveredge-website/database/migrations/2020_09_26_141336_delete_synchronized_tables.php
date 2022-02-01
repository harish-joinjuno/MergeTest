<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteSynchronizedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('synchronized_tables');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('synchronized_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table_name');
            $table->string('google_sheet_id');
        });
    }
}
