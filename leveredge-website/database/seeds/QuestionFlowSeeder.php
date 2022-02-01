<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QuestionFlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/roles.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/question_flows.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/question_pages.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/contents.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/questions.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/academic_years.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/negotiation_groups.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/negotiation_group_eligible_profiles_0_5000.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/negotiation_group_eligible_profiles_5001_10000.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/negotiation_group_eligible_profiles_10001_15000.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/negotiation_group_eligible_profiles_15001_20351.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/negotiation_group_end_screens.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/question-flows/info_card_elements.sql')));
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
