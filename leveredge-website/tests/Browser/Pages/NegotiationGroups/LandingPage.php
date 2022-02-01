<?php


namespace Tests\Browser\Pages\NegotiationGroups;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class LandingPage extends Page
{

    public function url()
    {
        return '/member/negotiation-group/15/refinance-deal-recommendation-questions/landing';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('Landing on the deal recommended for you');
    }


}
