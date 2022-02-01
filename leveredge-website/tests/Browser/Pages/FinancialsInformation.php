<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class FinancialsInformation extends Page
{
    public function url()
    {
        return '/question-flow/student-loan/financial-information';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function elements()
    {
        return [
            '@creditScore'          => 'credit_score',
            '@annualIncome'         => 'annual_income',
            '@cosignerStatus'       => 'cosigner_status',
            '@cosignerCreditScore'  => 'cosigner_credit_score',
            '@cosignerAnnualIncome' => 'cosigner_annual_income',
            '@gradUniversityId'     => 'grad_university_id',
            '@gradDegreeId'         => 'grad_degree_id',
            '@gradMonthYear'        => 'graduate_month_year',
            '@loanAmount'           => 'loan_amount',
            '@submit'               => '[type=Submit]'
        ];
    }

    public function fillFinancialsInformationAsStudent(Browser $browser)
    {
        $browser->select('@cosignerStatus', 'No')
            ->type('@loanAmount', 100000);
        $this->fillBasicInformation($browser);
    }

    public function fillFinancialsInformationAsParent(Browser $browser)
    {
        $browser->select('@cosignerCreditScore', 'Above 800')
            ->type('@cosignerAnnualIncome', 50000);

        $this->fillBasicInformation($browser);
    }

    public function fillAboutInformation(Browser $browser)
    {
        $browser->select('@gradUniversityId', 685)
            ->select('@gradDegreeId', 1)
            ->type('@gradMonthYear', '2020-10')
            ->click('@submit');
    }

    private function fillBasicInformation($browser)
    {
        $browser->select('@creditScore', 'Above 800')
            ->type('@annualIncome', 50000)
            ->click('@submit');
    }
}
