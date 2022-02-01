<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int        $id
 * @property int        $degree_id
 * @property int        $university_id
 * @property int        $average_reported_aid_amount
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 * @property University $university
 * @property Degree     $degree
 */
class FinancialAidTrackerEligibleProgram extends Model
{
    protected $fillable = [
        'university_id',
        'degree_id',
        'chart_label',
        'average_reported_aid_amount',
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'degree_id');
    }

    public static function whereInMultiple(array $columns, array $values)
    {
        if (empty($columns) || empty($values)) {
            return static::query();
        }

        $values = array_map(function (array $value) {
            return "('" . implode("', '", $value) . "')";
        }, $values);

        return static::query()->whereRaw(
            '(' . implode(', ', $columns) . ') in (' . implode(', ', $values) . ')'
        );
    }
}
