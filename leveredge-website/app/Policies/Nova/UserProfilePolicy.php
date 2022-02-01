<?php


namespace App\Policies\Nova;

use App\UserProfile;

class UserProfilePolicy extends AbstractNovaPermissionHandler
{
	public $resource = UserProfile::class;
}
