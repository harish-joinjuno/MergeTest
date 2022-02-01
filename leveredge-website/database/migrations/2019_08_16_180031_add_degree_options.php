<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDegreeOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $degree_options = [
            'MBA',
            'JD',
            'Dental',
            'Medical',
            'Engineering',
            'Nursing',
            'Undergraduate',
            'Dual Degree',
            'Other',
            "Physician's Assistant"
        ];

        foreach($degree_options as $degree_option){
            $degree = new \App\Degree();
            $degree->name = $degree_option;
            $degree->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table('degrees')->truncate();
    }
}
