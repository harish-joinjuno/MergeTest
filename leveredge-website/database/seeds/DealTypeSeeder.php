<?php

use App\DealType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DealTypeSeeder extends Seeder
{
    public function run()
    {
        $defaultTypes = [
            0 => [
                'name' => 'Graduate Student Loan'
            ],

            1 => [
                'name' => 'Undergraduate Student Loan'
            ],

            2 => [
                'name' => 'Grad and Undergrad Student Loan'
            ],

            3 => [
                'name' => 'Refinance Student Loan'
            ]
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DealType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach($defaultTypes as $type) {
            DealType::create($type);
        }
    }
}
