<?php


namespace App\Policies\Nova;

use App\User;

class UserPolicy extends AbstractNovaPermissionHandler
{
	public $resource = User::class;
}
