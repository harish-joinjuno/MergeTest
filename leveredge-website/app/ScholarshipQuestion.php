<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * Class ScholarshipQuestion
 * @package App
 * @property int $id
 * @property int $scholarship_id
 * @property string $label
 * @property string $type
 * @property string $field_name
 * @property string $validation_rules
 * @property string|null $helper_text
 * @property-read Scholarship $scholarship
 */
class ScholarshipQuestion extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name'  => 'sort_order',
        'sort_when_creating' => true,
        'sort_on_has_many'   => true,
    ];

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }

    public function buildSortQuery()
    {
        return static::query()->where('scholarship_id', $this->scholarship_id);
    }
}
