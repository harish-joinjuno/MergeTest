<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $addHttpCookie = true;

    protected $except = [
        'refinance-webhook',
        'inschool-webhook',
        '/webhooks/*',
        '/webhook/*',
        '/api/disclosure-information',
        '/helpscout/member',
        '/socially-powered/*',
    ];
}
