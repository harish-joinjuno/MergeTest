<?php


namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class UserProfileEnd extends Page
{
    public function url()
    {
        return '/user-profile/end';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function elements()
    {
        return [
            '@goToDeals' => '#go-to-the-deals',
        ];
    }

    public function assertRefiDomesticNoJobNoCosigner(Browser $browser)
    {
//        $browser->waitFor('.something', 10);
        $browser->assertSee('We are ready to share a deal with you');
        $browser->assertSee('Here are the next steps!');
        $browser->assertSee('Check Out the Deal');
        $browser->assertSee('Ask us Anything!');
        $browser->assertSee('To see what we recommend for your situation, fill out three quick questions by clicking below!');
        $browser->assertSee("We’re happy to chat if there’s anything on your mind.");
        $browser->click('@goToDeals');
    }
}
