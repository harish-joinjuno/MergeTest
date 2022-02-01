<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            $table->string('top_message')->nullable()->change();
            $table->text('quote')->nullable()->change();
            $table->string('quote')->nullable()->change();
            $table->string('quote_author')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            $table->string('top_message')->change();
            $table->text('quote')->change();
            $table->string('quote')->change();
            $table->string('quote_author')->change();
        });
    }
}
