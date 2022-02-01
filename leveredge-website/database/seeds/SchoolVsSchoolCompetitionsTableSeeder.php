<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolVsSchoolCompetitionsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('school_vs_school_competitions')->insert([
            'university_id_one'     => 1,
            'degree_id_one'         => 1,
            'colloquial_name_one'   => 'Uni 1',
            'class_size_one'        => 1000,
            'university_id_two'     => 2,
            'degree_id_two'         => 1,
            'colloquial_name_two'   => 'Uni 2',
            'class_size_two'        => 500,
            'first_prize_amount'    => 1000,
            'second_prize_amount'   => 500
        ]);

        DB::table('school_vs_school_competitions')->insert([
            'university_id_one'     => 1,
            'degree_id_one'         => 1,
            'colloquial_name_one'   => 'Uni 3',
            'class_size_one'        => 800,
            'university_id_two'     => 2,
            'degree_id_two'         => 1,
            'colloquial_name_two'   => 'Uni 4',
            'class_size_two'        => 759,
            'first_prize_amount'    => 1000,
            'second_prize_amount'   => 500
        ]);

        DB::table('school_vs_school_competition_entrants')->insert([
            'school_vs_school_competition_id'   => 1,
            'colloquial_slug'                   => \Illuminate\Support\Str::slug( 'Uni 1' ),
            'first_name'                        => 'nikhil',
            'email'                             => 'nikhil@leveredge.org',
            'verified'                          => 1,
            'verification_code'                 => \Illuminate\Support\Str::random(8),
        ]);

        DB::table('school_vs_school_competition_entrants')->insert([
            'school_vs_school_competition_id'   => 1,
            'colloquial_slug'                   => \Illuminate\Support\Str::slug( 'Uni 2' ),
            'first_name'                        => 'agarwal',
            'email'                             => 'nikhil+2@leveredge.org',
            'verified'                          => 1,
            'verification_code'                 => \Illuminate\Support\Str::random(8),
        ]);

        DB::table('school_vs_school_competition_entrants')->insert([
            'school_vs_school_competition_id'   => 2,
            'colloquial_slug'                   => \Illuminate\Support\Str::slug( 'Uni 3' ),
            'first_name'                        => 'Joe',
            'email'                             => 'joe+1@leveredge.org',
            'verified'                          => 0,
            'verification_code'                 => \Illuminate\Support\Str::random(8),
        ]);


    }
}
