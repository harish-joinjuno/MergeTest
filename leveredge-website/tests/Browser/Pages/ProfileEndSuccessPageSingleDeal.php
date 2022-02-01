<?php


namespace Tests\Browser\Pages;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class ProfileEndSuccessPageSingleDeal extends Page
{

    public function url()
    {
        return '/user-profile/end';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('We have a deal for you');
        $browser->assertSee('Here are the next steps!');
        $browser->assertSee('How this works');
        $browser->assertSee('Ask us anything!');
        $browser->assertSee('See the deal');
        $browser->assertSee('Back');
    }

    public function checkTheDeal(Browser $browser)
    {
        $browser->click('#go-to-the-deals');
    }
}
