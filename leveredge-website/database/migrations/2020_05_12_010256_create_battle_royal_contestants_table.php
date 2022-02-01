<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBattleRoyalContestantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battle_royal_contestants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('count');
            $table->string('color');
            $table->timestamps();
        });


        //     { name: 'Anderson', count: 111, color: "#2774AE" },
        //     { name: 'Booth', count: 83, color: "#800000" },
        //     { name: 'CBS', count: 76, color: "#0081CC" },
        //     { name: 'GSB', count: 176, color: "#8C1515"},
        //     { name: 'Haas', count: 84, color: "#15284B" },
        //     { name: 'HBS', count: 104, color: "#A41034" },
        //     { name: 'Kellogg', count: 108, color: "#4F2582" },
        //     { name: 'Marshall', count: 59, color:"#a21933" },
        //     { name: 'Sloan', count: 76, color: "#a31f34" },
        //     { name: 'Wharton', count: 38, color: "#004785" },

        DB::table('battle_royal_contestants')->insert([
           ['name' => 'Anderson',   'count' => 111, 'color' => '#2774AE'],
           ['name' => 'Booth',      'count' => 83, 'color' => '#800000'],
           ['name' => 'CBS',        'count' => 76, 'color' => '#0081CC'],
           ['name' => 'GSB',        'count' => 176, 'color' => '#8C1515'],
           ['name' => 'Haas',       'count' => 84, 'color' => '#15284B'],
           ['name' => 'HBS',        'count' => 104, 'color' => '#A41034'],
           ['name' => 'Kellogg',    'count' => 108, 'color' => '#4F2582'],
           ['name' => 'Marshall',   'count' => 59, 'color' => '#a21933'],
           ['name' => 'Sloan',      'count' => 76, 'color' => '#a31f34'],
           ['name' => 'Wharton',    'count' => 38, 'color' => '#004785']
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('battle_royal_contestants');
    }
}
