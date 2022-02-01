<?php


namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class LoanTypeAcademicYear extends Page
{
    public function url()
    {
        return '/question-flow/student-loan/when-do-you-need-the-loan';
    }

    public function assert(Browser $browser)
    {
        return $browser->assertPathIs($this->url());
    }

    public function elements()
    {
        return [
            '@rightNow'          => '#right_now',
            '@winterSpring2021'  => '#winterspring_2021',
            '@summer2021'        => '#summer_2021',
            '@fall2021AndBeyond' => '#fall_2021_beyond',
        ];
    }

    public function assertAcademicYearPageIsLoaded(Browser $browser)
    {
        $browser->assertSee('Right Now');
        $browser->assertSee('Winter/Spring 2021');
        $browser->assertSee('Summer 2021');
        $browser->assertSee('Fall 2021 & beyond');
    }

    public function clickRightNow(Browser $browser)
    {
        $browser->click('@rightNow');
    }

    public function clickWinterSpring2021(Browser $browser)
    {
        $browser->click('@winterSpring2021');
    }

    public function clickSummer2021(Browser $browser)
    {
        $browser->click('@summer2021');
    }

    public function clickFall2021AndBeyond(Browser $browser)
    {
        $browser->click('@fall2021AndBeyond');
    }
}
