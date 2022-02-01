<?php


namespace App\Policies\Nova;

use App\Payment;

class PaymentPolicy extends AbstractNovaPermissionHandler
{
	public $resource = Payment::class;
}
