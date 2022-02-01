<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarMakeCarModel
 * @package App
 * @property int $id
 * @property int $car_make_id
 * @property int $car_model_id
 * @property-read CarMake $carMake
 * @property-read CarModel $carModel
 */
class CarMakeCarModel extends Model
{

    protected $fillable = ['car_make_id', 'car_model_id'];

    public function carMake()
    {
        return $this->belongsTo(CarMake::class);
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }
}
