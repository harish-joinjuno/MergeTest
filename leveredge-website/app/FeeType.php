<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    const FIXED_AMOUNT_PER_LOAN          = 1;
    const PERCENTAGE_OF_LOANS_ORIGINATED = 2;

    protected $fillable = ['name'];

    public function deals()
    {
        return $this->hasMany(\App\Deal::class);
    }
}
