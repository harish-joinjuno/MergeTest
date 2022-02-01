<?php

use Illuminate\Database\Seeder;

class DealStatusApplicabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Deal::all()
            ->each(function ($deal, $index) {
                \App\DealStatusApplicability::create([
                    'deal_id'        => $deal->id,
                    'deal_status_id' => 8, // Signed the Loan
                    'sort_order'     => $index + 1,
                ]);

                \App\DealStatusApplicability::create([
                    'deal_id'        => $deal->id,
                    'deal_status_id' => 1, // Clicked to Provider
                    'sort_order'     => $index + 1,
                ]);
            });
    }
}
