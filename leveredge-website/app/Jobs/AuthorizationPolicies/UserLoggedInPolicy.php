<?php


namespace App\Jobs\AuthorizationPolicies;


use App\Exceptions\AuthPersistException;

class UserLoggedInPolicy
{
    public function handle()
    {
        if (! auth()->check()) {
            throw new AuthPersistException(self::class . ' - member should be logged in');
        }
    }
}
