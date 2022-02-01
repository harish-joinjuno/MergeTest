<?php

namespace App\Policies;

use App\University;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UniversityPolicy
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

    public function view(User $user, University $university)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, University $university)
    {
        return false;
    }

    public function delete(User $user, University $university)
    {
        return false;
    }

    public function restore(User $user, University $university)
    {
        return false;
    }

    public function forceDelete(User $user, University $university)
    {
        return false;
    }
}
