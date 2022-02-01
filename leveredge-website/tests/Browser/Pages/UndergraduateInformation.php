<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class UndergraduateInformation extends GraduatePage
{
    public $universityId = 530;

    public $degreeId = 13;

    public function url()
    {
        return '/question-flow/student-loan/undergraduate-information';
    }

    public function elements()
    {
        return [
            '@universityId'     => 'university_id',
            '@degreeId'         => 'degree_id',
            '@graduationYear'   => 'graduation_year',
            '@submit'           => '[type=Submit]',
        ];
    }

    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }
}
