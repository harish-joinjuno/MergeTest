<?php


namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class DomesticRefiInformation extends Page
{
    public function url()
    {
        return '/question-flow/student-refi-with-intl/domestic-refi-comp-2-2';
    }

    public function elements()
    {
        return [
            '@refiLoanType'         => 'refinance_loan_type',
            '@currentlyEmployed'    => 'is_currently_employed',
            '@submit'               => '[type=Submit]',
        ];
    }

    public function privateAndEmployed(Browser $browser)
    {
        $browser->select('@refiLoanType', 'private')
            ->select('@currentlyEmployed', 1)
            ->click('@submit');
    }
}
