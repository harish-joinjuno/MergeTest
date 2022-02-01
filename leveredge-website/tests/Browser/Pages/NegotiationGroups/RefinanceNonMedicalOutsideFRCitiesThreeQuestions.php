<?php


namespace Tests\Browser\Pages\NegotiationGroups;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class RefinanceNonMedicalOutsideFRCitiesThreeQuestions extends Page
{

    public function url()
    {
        return '/member/negotiation-group/17/refinance-deal-recommendation-questions';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('Three important questions');
        $browser->assertSee('Along with your profile information, your answers will help us recommend which of our deals is the best fit for you.');
    }

    public function continue(Browser $browser)
    {
        $browser->click('.btn-primary');
    }
}
