<?php


namespace App\Policies\Nova;


use App\NovaResourcePermission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @property $resource
 */
abstract class AbstractNovaPermissionHandler
{
    use HandlesAuthorization;

    public $resource;

    public function viewAny(User $user)
    {
        return $user->canViewAny($this->resource);
    }

    public function view(User $user)
    {
        return $user->canSee($this->resource);
    }

    public function create(User $user)
    {
        return $user->canCreate($this->resource);
    }

    public function update(User $user)
    {
        return $user->canUpdate($this->resource);
    }

    public function delete(User $user)
    {
        return $user->canDelete($this->resource);
    }
}
