<?php


namespace App\Redirects\QuestionPageRedirects;


use App\Contracts\Redirects\RedirectsInterface;

class RedirectToCollegeTestPrepV1 implements RedirectsInterface
{

    public function url(): string
    {
        return '/test-prep/college-test-prep/v1';
    }
}
