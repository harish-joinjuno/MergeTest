<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedGraduatedStudiesInDegreesTable extends Migration
{
    public function up()
    {
        DB::table('degrees')
            ->where('name', '=', 'Undergraduate')
            ->delete();

        DB::table('degrees')
            ->whereNull('degree_type')
            ->update([
                'degree_type' => 'graduate',
            ]);
    }

    public function down()
    {

    }
}
