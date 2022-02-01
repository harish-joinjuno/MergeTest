<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FederalLoanTracker
 * @package App
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $source
 * @property Carbon $posted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class FederalLoanTracker extends Model
{
    use SoftDeletes;

    protected $casts = [
        'posted_at' => 'date:Y-m-d',
    ];

    public function getPostedAtAttribute($value)
    {
        if (is_null($value)) {
            return $this->created_at;
        }

        return Carbon::createFromFormat('Y-m-d', $value);
    }
}
