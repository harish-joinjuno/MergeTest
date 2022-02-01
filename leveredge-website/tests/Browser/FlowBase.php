<?php

namespace Tests\Browser;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Browser\Pages\FinancialsInformation;
use Tests\Browser\Pages\GraduateInformation;
use Tests\Browser\Pages\LoanType;
use Tests\Browser\Pages\LoanTypeSuccessPage;
use Tests\Browser\Pages\PersonalInformation;
use Tests\Browser\Pages\RefinanceInformation;
use Tests\Browser\Pages\Register;
use Tests\Browser\Pages\UndergraduateInformation;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class FlowBase extends DuskTestCase
{
    use WithFaker;

    public function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless',
            '--window-size=1920,1080',
            'detach=true',
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
            ChromeOptions::CAPABILITY, $options
        )
        );
    }
}
