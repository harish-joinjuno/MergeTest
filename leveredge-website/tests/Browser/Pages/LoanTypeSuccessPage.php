<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class LoanTypeSuccessPage extends Page
{
    public function url()
    {
        return '/user-profile/end';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function assertAccountSuccessfullyCreated(Browser $browser, $firstName)
    {
        $browser->assertSee("Thank you for sharing {$firstName}")
        ->clickLink('Done')
        ->assertSee("Hi, {$firstName}");
    }
}
