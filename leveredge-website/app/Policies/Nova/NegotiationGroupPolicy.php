<?php


namespace App\Policies\Nova;

use App\NegotiationGroup;

class NegotiationGroupPolicy extends AbstractNovaPermissionHandler
{
	public $resource = NegotiationGroup::class;
}
