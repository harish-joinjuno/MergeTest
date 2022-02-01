<?php


namespace Tests\Browser\Pages\NegotiationGroups;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class RefinanceNonMedicalOutsideFRCitiesZipCode extends Page
{

    public function url()
    {
        return '/member/negotiation-group/17/refinance-deal-recommendation-questions/zip-code';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('Where do you live?');
        $browser->assertSee("Certain lenders offering favorable rates limit their service to specific cities.");
    }

    public function provideZipCode(Browser $browser)
    {
        $browser->type('zip_code', 12345);
        $browser->click('[type="submit"]');
    }

    public function provideInFRZipCode(Browser $browser)
    {
        $browser->type('zip_code', 94022);
        $browser->click('[type="submit"]');
    }
}
