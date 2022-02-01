<?php

namespace App\Policies;

use App\Degree;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DegreePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        return $user->hasRole('admin');
    }

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, Degree $degree)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Degree $degree)
    {
        return false;
    }

    public function delete(User $user, Degree $degree)
    {
        return false;
    }

    public function restore(User $user, Degree $degree)
    {
        return false;
    }

    public function forceDelete(User $user, Degree $degree)
    {
        return false;
    }
}
