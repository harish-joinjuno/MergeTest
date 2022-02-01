<?php

namespace App\Policies;

use App\PageSection;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PageSectionPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if (in_array($ability, ['create', 'delete'])) {
            return false;
        }

        return $user->hasRole('admin');
    }

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, PageSection $pageSection)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, PageSection $pageSection)
    {
        return false;
    }

    public function delete(User $user, PageSection $pageSection)
    {
        return false;
    }

    public function restore(User $user, PageSection $pageSection)
    {
        return false;
    }

    public function forceDelete(User $user, PageSection $pageSection)
    {
        return false;
    }
}
