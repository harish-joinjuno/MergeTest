<?php


namespace App\Integrations\Contracts;


use App\Payment;
use App\User;

interface PayableInterface
{
    public function send(User $from, User $to, int $amount ) : Payment;
}
