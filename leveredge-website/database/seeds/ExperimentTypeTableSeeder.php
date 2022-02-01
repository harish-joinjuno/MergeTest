<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ExperimentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('experiment_types')->truncate();
        \Illuminate\Support\Facades\DB::unprepared(file_get_contents(database_path('seeds/experiment_types.sql')));
        Schema::enableForeignKeyConstraints();
    }
}
