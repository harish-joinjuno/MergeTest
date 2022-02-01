<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $term
 * @property string $apr
 * @property string $type
 * @property string $internal_name
 *
 * @property int $rate_id
 * @property-read Rate[] $rate
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class RateProperty extends Model
{
    const RATE_TYPE_FIXED    = 'fixed';
    const RATE_TYPE_VARIABLE = 'variable';

    const RATE_TYPES = [
        self::RATE_TYPE_FIXED    => 'Fixed',
        self::RATE_TYPE_VARIABLE => 'Variable',
    ];

    const RATE_TERMS = [
        '5 years'  => '5 years',
        '7 years'  => '7 years',
        '8 years'  => '8 years',
        '10 years' => '10 years',
        '12 years' => '12 years',
        '15 years' => '15 years',
        '20 years' => '20 years',
    ];

    public function rate()
    {
        return $this->belongsToMany(Rate::class, 'rate_property_rate');
    }
}
