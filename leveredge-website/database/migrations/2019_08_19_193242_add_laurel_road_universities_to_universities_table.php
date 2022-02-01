<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLaurelRoadUniversitiesToUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $universities_to_add = [
            "Frontier Nursing University",
            "Iowa State University",
            "St. Louis University",
            "Stony Brook University - SUNY",
            "University at Buffalo SUNY",
            "University of Puerto Rico",
            "Virginia Tech",
            "Arizona School of Dentistry and Oral Health - A.T. Still University",
            "University of Colorado Anschutz Medical Campus"
        ];

        foreach($universities_to_add as $name){
            if(!\App\University::where('name',$name)->exists() ){
                $university = new \App\University();
                $university->name = $name;
                $university->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $universities_to_add = [
            "Frontier Nursing University",
            "Iowa State University",
            "St. Louis University",
            "Stony Brook University - SUNY",
            "University at Buffalo SUNY",
            "University of Puerto Rico",
            "Virginia Tech",
            "Arizona School of Dentistry and Oral Health - A.T. Still University",
            "University of Colorado Anschutz Medical Campus"
        ];

        foreach($universities_to_add as $name){
            \App\University::where('name',$name)->delete();
        }
    }
}
