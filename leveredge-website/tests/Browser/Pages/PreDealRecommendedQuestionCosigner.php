<?php


namespace Tests\Browser\Pages;


use Laravel\Dusk\Browser;

class PreDealRecommendedQuestionCosigner extends Page
{

    public function url()
    {
        return '/member/negotiation-group/9/pre-deal-recommendation-questions/co-signer-question';
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee('Do you have a co-signer?');
        $browser->assertSee("A cosigner is a person who is obligated to pay back the loan if you, the student, don't make your payments. Your co-signer can be a parent, relative, spouse or any adult. Members with co-signers are more likely to get the lowest rate.");
    }

    public function goToNextQuestion(Browser $browser)
    {
        $browser->click('#next-btn');
    }
}
