<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLendersTableAgain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('lenders')->insert(
            [
                ['name' => 'Ascent'],
                ['name' => 'Citizens Bank'],
                ['name' => 'CommonBond'],
                ['name' => 'College Ave'],
                ['name' => 'Discover Student Loans'],
                ['name' => 'EDvestinU'],
                ['name' => 'INvestEd'],
                ['name' => 'MEFA'],
                ['name' => 'Sallie Mae'],
                ['name' => 'SoFi'],
                ['name' => 'Earnest'],
                ['name' => 'LendKey'],
                ['name' => 'Other'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lenders');
    }
}
