<?php


namespace App\Scopes;

use App\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class NovaUserScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('roles', function ($q) {
            return $q->whereName(Role::ROLE_NAME_NOVA_USER);
        });
    }
}
