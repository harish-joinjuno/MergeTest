<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $ip
 */
class InternalIpAddress extends Model
{
    protected $fillable = [
        'name',
        'ip',
    ];
}
