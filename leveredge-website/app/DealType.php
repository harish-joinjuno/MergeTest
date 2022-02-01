<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class DealType extends Model
{
    const GRADUATE_STUDENT_LOAN                  = 1;
    const UNDERGRADUATE_STUDENT_LOAN             = 2;
    const GRAD_AND_UNDERGRAD_STUDENT_LOAN        = 3;
    const REFINANCE_STUDENT_LOAN                 = 4;
    const INTERNATIONAL_STUDENT_HEALTH_INSURANCE = 5;

    protected $fillable = ['name'];

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = $model->max('id') + 1;
        });
    }

    public function deals()
    {
        return $this->hasMany(\App\Deal::class);
    }
}
