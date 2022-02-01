<?php


namespace App\Scopes;


use App\Degree;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UndergraduateScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereType(Degree::TYPE_UNDERGRADUATE);
    }
}
