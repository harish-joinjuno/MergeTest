<?php


namespace App\Policies\Nova;

use App\PaymentMethod;

class PaymentMethodPolicy extends AbstractNovaPermissionHandler
{
	public $resource = PaymentMethod::class;
}
