<?php

use Illuminate\Database\Seeder;

class FaqGroupTableSeeder extends Seeder
{
    public function run()
    {
        $groups = [
            'CommonBond Deal Detail Page',
            'Earnest Deal Detail Page (Grad)',
            'Earnest Deal Detail Page (Undergrad)',
            'Credible Deal Detail Page',
            'Comparison Page for Students at CommonBond Eligible MBA Programs (Group 1)',
            'Comparison Page for Grad Students at Non-CommonBond Eligible MBA Programs (Group 2)',
            'Comparison Page for Undergraduate Students',
        ];

        foreach ($groups as $groupName) {
            \App\FaqGroup::create([
                'name' => $groupName,
            ]);
        }
    }
}
