<?php


namespace Tests\Browser\Pages\NegotiationGroups;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class LaurelRoadDeal extends Page
{

    public function url()
    {
        return '/member/negotiation-group/15/laurel-road-deal';
    }

    public function assert(Browser $browser)
    {
        $browser->assertSee('Laurel Road offers competitive rates for refinancing your student loans.');
        $browser->assertSee('As a Juno member, Laurel Road will offer you a rate reduction of 0.25%. In addition, you may be able to pay back your medical school loans at only $100 per month while in residency or fellowship.');
    }
}
