<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property int              $id
 * @property int              $negotiation_group_id
 * @property string           $name
 * @property Carbon           $created_at
 * @property Carbon           $updated_at
 * @property NegotiationGroup $negotiationGroup
 */
class NegotiationGroupFaqCategory extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name'  => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }

    public function negotiationGroup()
    {
        return $this->belongsTo(NegotiationGroup::class);
    }

    public function negotiationGroupFaqs()
    {
        return $this->hasMany(NegotiationGroupFaq::class);
    }
}
