<?php


namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class StudentLoan extends Page
{
    public function url()
    {
        return '/question-flow/student-loan/loan-type';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function elements()
    {
        return [
            '@undergraduateStudentLoan' => '#undergraduate',
            '@graduateStudentLoan'      => '#graduate',
        ];
    }

    public function assertStudentLoansPageIsLoaded(Browser $browser)
    {
        $browser->assertSee('What kind of loan are you looking for?');
        $browser->assertSee('Undergraduate');
        $browser->assertSee('For current or incoming undergraduate students and their parents/guardians');
        $browser->assertSee('Graduate');
        $browser->assertSee('For current or incoming MBA, JD, MD, and other graduate students.');
    }

    public function graduateLoan(Browser $browser)
    {
        $browser->click('@graduateStudentLoan');
    }

    public function undergradLoad(Browser $browser)
    {
        $browser->click('@undergraduateStudentLoan');
    }
}
