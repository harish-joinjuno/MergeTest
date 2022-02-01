<?php


namespace App\Redirects;


use App\Contracts\Redirects\RedirectsInterface;

class RedirectToAcademicYear2122PostAuth implements RedirectsInterface
{
    public function url(): string
    {
        return '/member/academic-year-21-22/post-auth';
    }
}
