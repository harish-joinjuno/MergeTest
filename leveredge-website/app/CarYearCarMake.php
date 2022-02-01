<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarYearCarMake
 * @package App
 * @property int $car_year_id
 * @property int $car_make_id
 * @property-read CarYear $carYear
 * @property-read CarMake $carMake
 */
class CarYearCarMake extends Model
{

    protected $fillable = ['car_year_id', 'car_make_id'];

    public function carYear()
    {
        return $this->belongsTo(CarYear::class);
    }

    public function carMake()
    {
        return $this->belongsTo(CarMake::class);
    }
}
