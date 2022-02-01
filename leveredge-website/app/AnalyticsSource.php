<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class AnalyticsSource
 * @package App
 * @property int $id
 * @property string $name
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class AnalyticsSource extends Model
{
    protected $fillable = [
        'name',
    ];
}
