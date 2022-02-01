<?php


namespace Tests\Browser\Pages;


use Laravel\Dusk\Browser;

class EarnestUndergraduateDealPage extends Page
{

    public function url()
    {
        return '/member/negotiation-group/10/earnest-undergraduate-deal';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('Earnest Private Student Loans offer Juno Members 1.00% lower rates than you’d get if you directly applied at Earnest!');
        $browser->assertSee('Check my rate');
    }
}
