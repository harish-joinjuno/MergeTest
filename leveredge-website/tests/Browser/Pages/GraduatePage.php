<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class GraduatePage extends Page
{
    public $universityId;

    public $degreeId;

    public function url()
    {
        return '/';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function fillBasicGraduateInformation(Browser $browser)
    {
        $browser->select('@universityId', $this->universityId)
            ->select('@degreeId', $this->degreeId)
            ->type('@graduationYear', 2011)
            ->click('@submit');
    }
}
