<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class CarMake
 * @package App
 * @property int $id
 * @property string $make
 * @property-read CarMakeCarModel[]|Collection $carMakeCarModels
 */
class CarMake extends Model
{

    protected $fillable = ['make'];

    public function carMakeCarModels()
    {
        return $this->hasMany(CarMakeCarModel::class);
    }
}
