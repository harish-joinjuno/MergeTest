<?php


namespace App\Policies\Nova;

use App\NegotiationGroupUser;

class NegotiationGroupUserPolicy extends AbstractNovaPermissionHandler
{
	public $resource = NegotiationGroupUser::class;
}
