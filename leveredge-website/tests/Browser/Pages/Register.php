<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class Register extends Page
{
    public function url()
    {
        return '/';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function elements()
    {
        return [
            '@enroll-btn' => '#submit-enroll-form-button',
            '@submit-btn' => '[type=Submit]'
        ];
    }

    public function createAccount(Browser $browser, $email, $password)
    {
        $browser->type('email', $email)
            ->click('@enroll-btn')
            ->assertInputValue('email', $email)
            ->type('password', $password)
            ->click('@submit-btn');
//            ->clickLink("Understood. Let's Complete My Profile");
    }
}
