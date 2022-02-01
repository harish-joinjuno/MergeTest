<?php


namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class RefinanceDomesticFinancialInformation extends Page
{
    public function url()
    {
        return '/question-flow/student-refi-with-intl/financial-information-refinance-us';
    }

    public function elements()
    {
        return [
            '@creditScore'  => 'credit_score',
            '@annualIncome' => 'annual_income',
            '@cosigner'     => 'cosigner_status',
            '@submit'       => '[type=Submit]'
        ];
    }

    public function withoutCosigner(Browser $browser)
    {
        $browser->select('@creditScore', 'Above 800')
            ->type('@annualIncome', 50000)
            ->select('@cosigner', 'No')
            ->click('@submit');
    }
}
