<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int university_id
 * @property int degree_id
 * @property string     $gpa
 * @property int        $gmat_score
 * @property int        $gre_score
 * @property int        $aid_amount
 * @property int        $graduation_year
 * @property string     $immigration_status
 * @property string     $aid_qualification
 * @property int        $income_3
 * @property int        $income_2
 * @property int        $income_1
 * @property int        $current_income
 * @property int        $liquid_assets
 * @property int        $illiquid_assets
 * @property int        $liabilities
 * @property int        $total_mortgage
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 * @property University $university
 * @property Degree     $degree
 */
class FinancialAidTracker extends Model
{
    protected $fillable = [
        'university_id',
        'degree_id',
        'gpa',
        'gmat_score',
        'gre_score',
        'aid_amount',
        'graduation_year',
        'immigration_status',
        'aid_qualification',
        'income_3',
        'income_2',
        'income_1',
        'current_income',
        'liquid_assets',
        'illiquid_assets',
        'liabilities',
        'total_mortgage',
        'email',
    ];

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
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
