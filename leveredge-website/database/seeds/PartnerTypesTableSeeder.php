<?php

use App\PartnerType;
use Illuminate\Database\Seeder;

class PartnerTypesTableSeeder extends Seeder
{
    public function run()
    {
        $type       = new PartnerType();
        $type->type = 'Campus Ambassador';
        $type->save();
    }
}
