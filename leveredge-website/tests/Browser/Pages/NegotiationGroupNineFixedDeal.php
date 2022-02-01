<?php


namespace Tests\Browser\Pages;


use Laravel\Dusk\Browser;

class NegotiationGroupNineFixedDeal extends Page
{
    public function url()
    {
        return '/member/negotiation-group/9/fixed-deal';
    }

    public function assert(Browser $browser)
    {
        $browser->waitForLocation($this->url(), 5);
        $browser->assertSee('Negotiated just for you');
        $browser->assertSee('Fixed Rate Option');
        $browser->assertSee('Earnest Private Student Loan');
    }
}
