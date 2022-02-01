<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutoRefinanceExperiments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('experiments')->insert([
            ['name' => 'Auto Refinance Sign Up - Control'],
            ['name' => 'Auto Refinance Sign Up - Skip Password'],
            ['name' => 'Auto Refinance Sign Up - Get Last 4 SSN'],
            ['name' => 'Auto Refinance Sign Up - Minimum Questions'],
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
