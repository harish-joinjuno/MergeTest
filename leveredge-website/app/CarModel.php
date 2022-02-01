<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarModel
 * @package App
 * @property int $id
 * @property string $model
 */
class CarModel extends Model
{
    protected $fillable = ['model'];
}
