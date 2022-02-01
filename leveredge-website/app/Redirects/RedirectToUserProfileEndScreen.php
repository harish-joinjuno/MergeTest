<?php


namespace App\Redirects;


use App\Contracts\Redirects\RedirectsInterface;

class RedirectToUserProfileEndScreen implements RedirectsInterface
{

    public function url(): string
    {
        return '/user-profile/end';
    }
}
