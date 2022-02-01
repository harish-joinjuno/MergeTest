<?php


namespace Tests\Browser\Pages;


use Laravel\Dusk\Browser;

class PreDealRecommendedQuestionVariableRates extends Page
{

    public function url()
    {
        return '/member/negotiation-group/9/pre-deal-recommendation-questions/variable-rates-page';
    }

    public function assert(Browser $browser)
    {
        $browser->assertSee('Are you open to variable rates?');
        $browser->assertSee("Generally, our members have preferred fixed rate loans—which makes sense most of the time—but this year variable rates are so low that many members are considering them instead.");
    }

    public function selectVariableRate(Browser $browser)
    {
        $browser->waitFor('#label-for-yes', 2);
        $browser->click('#label-for-yes');
        $browser->waitForText("Got it. You can always change your mind later. We’ll show you your variable rate options first.",1);
    }

    public function selectFixedRate(Browser $browser)
    {
        $browser->waitFor('#label-for-no', 2);
        $browser->click('#label-for-no');
        $browser->waitForText('Understood. You can always change your mind later if you decide you want to check out your variable rate options. We’ll just show you your fixed rate option for now.');
    }

    public function goToDealPage(Browser $browser)
    {
        $browser->click('#next-btn');
    }
}
