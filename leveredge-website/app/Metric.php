<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $metric_definition
 * @property-read string $title
 * @property-read string $description
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Metric extends Model
{
    protected $appends = [
        'title',
        'description',
    ];

    public function getTitleAttribute()
    {
        if (class_exists($this->metric_definition)) {
            return call_user_func($this->metric_definition . '::getTitle');
        }

        return '';
    }

    public function getDescriptionAttribute()
    {
        if (class_exists($this->metric_definition)) {
            return call_user_func($this->metric_definition . '::getDescription');
        }

        return '';
    }

    public function computeValue(User $partner)
    {
        if (class_exists($this->metric_definition)) {
            return call_user_func($this->metric_definition . '::getValue',$partner);
        }

        return '';
    }

    public function contractTypeMetrics()
    {
        return $this->hasMany(ContractTypeMetric::class);
    }
}
