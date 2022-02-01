<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'affiliate',
        'accessCode',
        'leveredge_user_id',
        '_fbp',
        '_ga',
        'client_id',
    ];
}
