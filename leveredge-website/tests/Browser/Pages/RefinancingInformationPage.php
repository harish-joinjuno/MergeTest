<?php


namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class RefinancingInformationPage extends Page
{
    public function url()
    {
        return '/question-flow/student-loan-refinancing/refinance-information';
    }

    public function elements()
    {
        return [
            '@submitBtn' => '[type="submit"]',
        ];
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('Refinancing Information');
        $browser->assertSee('What kind of loans are you looking to refinance?');
        $browser->assertSee('Are you currently employed?');
        $browser->assertDontSee('Do you have an offer letter with a start date?');
    }

    public function notEmployedWithNoJobDate(Browser $browser)
    {
        $browser->select('refinance_loan_type', 'both');
        $browser->select('is_currently_employed', 1);
        $browser->click('@submitBtn');
    }
}
