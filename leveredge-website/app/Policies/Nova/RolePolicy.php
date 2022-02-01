<?php


namespace App\Policies\Nova;

use App\Role;

class RolePolicy extends AbstractNovaPermissionHandler
{
    public $resource = Role::class;
}
