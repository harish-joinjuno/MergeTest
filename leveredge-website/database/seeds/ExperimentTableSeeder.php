<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ExperimentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('experiments')->truncate();
        \Illuminate\Support\Facades\DB::unprepared(file_get_contents(database_path('seeds/experiments.sql')));
        Schema::enableForeignKeyConstraints();
    }
}
