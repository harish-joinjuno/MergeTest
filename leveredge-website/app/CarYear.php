<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class CarYear
 * @package App
 * @property int $id
 * @property int $year
 * @property-read CarYearCarMake[]|Collection $carYearCarMakes
 */
class CarYear extends Model
{

    protected $fillable = ['year'];

    public function carYearCarMakes()
    {
        return $this->hasMany(CarYearCarMake::class);
    }
}
