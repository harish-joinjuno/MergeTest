<?php


namespace Tests\Browser\Pages\NegotiationGroups;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class FirstRepublicAndLaurelRoadDeal extends Page
{

    public function url()
    {
        return '/member/negotiation-group/14/first-republic-and-laurel-road';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('Negotiated just for you');
        $browser->assertSee('First Republic');
        $browser->assertSee('Personal Line of Credit');
        $browser->assertSee('For being a Juno member, you’ll receive up to $800 cash back.');
        $browser->assertSee('Laurel Road');
        $browser->assertSee('Student Loan Refinancing');
        $browser->assertSee('As a Juno Member, you’ll receive a 0.25% rate reduction from the lender.');
    }
}
