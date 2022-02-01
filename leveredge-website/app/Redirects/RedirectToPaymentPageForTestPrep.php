<?php


namespace App\Redirects;


use App\Contracts\Redirects\RedirectsInterface;

class RedirectToPaymentPageForTestPrep implements RedirectsInterface
{

    public function url(): string
    {
        return 'payments-test-prep';
    }
}
