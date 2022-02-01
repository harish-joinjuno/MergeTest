<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property int $id
 * @property int $deal_id
 * @property int $deal_status_id
 * @property int $sort_order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class DealStatusApplicability extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name'  => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'deal_id',
        'deal_status_id',
        'sort_order',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }

    public function dealStatus()
    {
        return $this->belongsTo(DealStatus::class, 'deal_status_id');
    }
}
