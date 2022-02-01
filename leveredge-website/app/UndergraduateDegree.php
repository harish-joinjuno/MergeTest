<?php

namespace App;

use App\Scopes\UndergraduateScope;

class UndergraduateDegree extends Degree
{
    public $table = 'degrees';

    protected static function booted()
    {
        static::addGlobalScope(new UndergraduateScope);
    }
}
