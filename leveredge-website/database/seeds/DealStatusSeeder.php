<?php

use Illuminate\Database\Seeder;

class DealStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loanStatuses = [
            'Clicked to Provider',
            'Started Application',
            'Submitted Eligibility Check',
            'Received Preliminary Quotes',
            'Submitted Complete Application',
            'Approved by Lender',
            'Received Quotes',
            'Signed the Loan',
            'Rejected by Lender',
            'Rejected by Borrower',
            'Quote Withdrawn by Lender',
        ];

        foreach ($loanStatuses as $loanStatus) {
            \App\DealStatus::create(['loan_status' => $loanStatus]);
        }
    }
}
