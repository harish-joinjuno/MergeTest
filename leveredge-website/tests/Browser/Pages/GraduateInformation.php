<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class GraduateInformation extends GraduatePage
{
    public $universityId = 530;

    public $degreeId = 1;

    public $baseElements = [
        '@universityId'     => 'grad_university_id',
        '@degreeId'         => 'grad_degree_id',
        '@graduationYear'   => 'grad_graduation_year',
        '@submit'           => '[type=Submit]'
    ];

    public function url()
    {
        return '/question-flow/student-loan/graduate-information';
    }

    public function elements()
    {
        return $this->baseElements;
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function proceedWithNo(Browser $browser)
    {
        $browser->click('@submit');
    }
}
