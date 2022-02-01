<?php


namespace App\Traits;

use App\User;

trait DeletedAccountCheckTrait
{
    public function abortIfAccountIsDeleted($email)
    {
        if ($user = User::whereEmail($email)->withTrashed()->first()) {
            if ($user->trashed()) {
                abort(423);
            }
        }
    }
}
