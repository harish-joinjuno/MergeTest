<?php

namespace App;


use App\Scopes\NovaUserScope;

class NovaUser extends User
{
    public $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope(new NovaUserScope);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id');
    }
}
