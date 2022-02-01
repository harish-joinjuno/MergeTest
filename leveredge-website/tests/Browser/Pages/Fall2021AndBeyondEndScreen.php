<?php


namespace Tests\Browser\Pages;


use Laravel\Dusk\Browser;

class Fall2021AndBeyondEndScreen extends Page
{

    public function url()
    {
        return '/user-profile/end';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee("Thanks for joining Juno!");
        $browser->assertSee('Welcome to the community');
        $browser->assertSee("Let's save some money together");
        $browser->assertSee('Click below to check out the campaign page, join the discussion and help grow the group so we call save more on student loans!');
        $browser->assertSee('Ask us anything!');
        $browser->assertSee("We're here to answer any questions, just drop us a line or give us a call.");
    }
}
