<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdToHeardFromOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('heard_from_options', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->after('name')->default(99);
        });

        \App\HeardFromOption::all()->each(function ($headerFromOption) {
            $headerFromOption->sort_order = $headerFromOption->id;
            $headerFromOption->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('heard_from_options', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
}
