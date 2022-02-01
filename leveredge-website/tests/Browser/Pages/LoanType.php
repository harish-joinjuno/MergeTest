<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class LoanType extends Page
{
    public function url()
    {
        return '/user-profile/loan-type';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function elements()
    {
        return [
            '@studentLoans'                        => '#student-loans',
            '@studentLoanRefinancing'              => '#refinance',
            '@internationalStudentHealthInsurance' => '#international-student-health-insurance',
            '@autoLoanRefinancing'                 => '#auto-loan-refinancing',
        ];
    }

    public function assertPageIsLoaded(Browser  $browser)
    {
        $browser->assertSee('Student Loans');
        $browser->assertSee('Student Loan Refinancing');
        $browser->assertSee('International Student Health Insurance');
        $browser->assertSee('Auto Loan Refinancing');
    }

    public function loanUndergraduate(Browser $browser)
    {
        $browser->click('@loanUndergraduate');
    }

    public function loanGraduate(Browser $browser)
    {
        $browser->click('@loanGraduate');
    }

    public function loanRefinance(Browser $browser)
    {
        $browser->click('@studentLoanRefinancing');
    }

    public function studentLoans(Browser $browser)
    {
        $browser->click('@studentLoans');
    }
}
