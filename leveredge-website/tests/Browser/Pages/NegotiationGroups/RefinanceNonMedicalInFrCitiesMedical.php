<?php


namespace Tests\Browser\Pages\NegotiationGroups;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class RefinanceNonMedicalInFrCitiesMedical extends Page
{

    public function url()
    {
        return '/member/negotiation-group/16/refinance-deal-recommendation-questions/medical';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee("What's your profession?");
        $browser->assertSee('Some lenders offer special rates for certain professions.');
    }

    public function chooseMedicalProfession(Browser $browser)
    {
        $browser->select('profession_id', 1);
        $browser->click('[type="submit"]');
    }
}
