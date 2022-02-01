<?php


namespace Tests\Browser\Pages;


use Laravel\Dusk\Browser;

class PreDealImportantQuestionsPage extends Page
{

    public function url()
    {
        return '/member/negotiation-group/9/pre-deal-recommendation-questions';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('Two important questions');
        $browser->assertSee('Along with your profile information, your answers will help us recommend which of our 2 deals is the best fit for you.');
    }

    public function continueToCosignerQuestion(Browser $browser)
    {
        $browser->click('#continue-btn');
    }
}
