<?php

use App\ContractType;
use Illuminate\Database\Seeder;

class ContractTypesTableSeeder extends Seeder
{
    public function run()
    {
        $type       = new ContractType();
        $type->type = 'Campus Ambassador Contract';
        $type->save();
    }
}
