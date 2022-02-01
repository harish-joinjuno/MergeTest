<?php


namespace App\Redirects;


use App\Contracts\Redirects\RedirectsInterface;

class RedirectToAutoLoansPostAuthPage implements RedirectsInterface
{
    public function url(): string
    {
        return '/loans/auto-refinance/post-auth';
    }
}
