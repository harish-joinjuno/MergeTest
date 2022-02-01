<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class RefinanceInformation extends GraduateInformation
{
    public function __construct()
    {
        $this->baseElements['@submit'] = '#submit-form';
    }

    public function proceedWithYes(Browser $browser)
    {
        $browser->click('@yesBtn');
        $browser->waitForText('Graduate Program Information', 2);
        $this->fillBasicGraduateInformation($browser);
    }
}
