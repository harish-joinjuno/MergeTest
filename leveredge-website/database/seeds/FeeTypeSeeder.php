<?php

use App\FeeType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeTypeSeeder extends Seeder
{
    public function run()
    {
        $defaultTypes = [
            0 => [
                'name' => 'Fixed Amount Per Loan'
            ],

            1 => [
                'name' => 'Percentage of Loans Originated'
            ]
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        FeeType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach($defaultTypes as $type) {
            FeeType::create($type);
        }
    }
}
