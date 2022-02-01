<?php


namespace Tests\Browser\Pages\NegotiationGroups;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class FirstRepublicAndLaurelRoadLandingPage extends Page
{

    public function url()
    {
        return '/member/negotiation-group/14/refinance-deal-recommendation-questions/landing';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('Landing on the deal recommended for you');
    }
}
