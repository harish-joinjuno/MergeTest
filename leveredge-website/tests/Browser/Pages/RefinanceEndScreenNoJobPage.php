<?php


namespace Tests\Browser\Pages;


use Laravel\Dusk\Browser;

class RefinanceEndScreenNoJobPage extends Page
{
    public function url()
    {
        return '/user-profile/refinance/end';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee("We'll be in touch");
        $browser->assertSee('Check out what we have now');
        $browser->assertSee("Click below to check out what’s in store for you once you’re ready to refi");
        $browser->assertSee('Ask us anything!');
        $browser->assertSee("If there’s anything on your mind, just drop us a line or give us a call");
    }
}
