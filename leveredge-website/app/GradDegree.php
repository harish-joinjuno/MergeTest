<?php

namespace App;

use App\Scopes\GraduateScope;

class GradDegree extends Degree
{
    public $table = 'degrees';

    protected static function booted()
    {
        static::addGlobalScope(new GraduateScope);
    }
}
