<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailExperimentsToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('experiments')->insert([
            ['name' => 'Emails to Dentists From Up Work'],
            ['name' => 'Emails to Surgeons From Up Work'],
            ['name' => 'Emails to Urgent Care From Up Work'],
            ['name' => 'Emails to Eye Care From Up Work'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
