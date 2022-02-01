<?php


namespace Tests\Browser\Pages\NegotiationGroups;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class RefinanceNonMedicalOutsideFRCitiesLoanAmount extends Page
{

    public function url()
    {
        return '/member/negotiation-group/17/refinance-deal-recommendation-questions/loan-amount';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('How much are you looking to refinance?');
        $browser->assertSee('Certain lenders have limits on the maximum you can refinance. We limit the options we show you to lenders you are more likely to be eligible to refinance with.');
    }

    public function provideLoanAmount(Browser $browser)
    {
        $browser->type('loan_amount', 5000);
        $browser->click('[type="submit"]');
    }
}
