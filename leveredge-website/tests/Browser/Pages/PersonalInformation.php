<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class PersonalInformation extends Page
{
    public function url()
    {
        return '/question-flow/student-loan/personal-information';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function elements()
    {
        return [
            '@role'              => 'role',
            '@firstName'         => 'first_name',
            '@lastName'          => 'last_name',
            '@citizenshipStatus' => 'citizenship_status',
            '@submit'            => '[type=Submit]'
        ];
    }

    public function fillPersonalInformationAsStudent(Browser $browser, $firstName, $lastName, $email = null)
    {
        if ($email) {
            $browser->type('email', $email);
        }
        $this->fillBasicInformation($browser, $firstName, $lastName);
    }

    public function fillPersonalInformationAsParent(Browser $browser, $firstName, $lastName)
    {
        $browser->select('@role', 'Parent');
        $this->fillBasicInformation($browser, $firstName, $lastName);
    }

    private function fillBasicInformation($browser, $firstName, $lastName)
    {
        $browser->type('first_name', $firstName)
            ->type('last_name', $lastName)
            ->select('immigration_status','U.S. Citizen or U.S. Permanent Resident')
            ->select('heard_from_option_id', '1')
            ->click('[type=Submit]');

    }

    public function assertPersonalInformationPageIsLoaded(Browser $browser)
    {
        $browser->assertSee('Personal Information');
        $browser->assertSee('Are you a student or a parent?');
        $browser->assertSee('Your First Name');
        $browser->assertSee('Your Last Name');
        $browser->assertSee('Your Citizenship Status');
        $browser->assertSee('Your Phone Number (Optional)');
        $browser->assertSee('How did you hear about us?');
    }
}
