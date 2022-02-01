<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property int                         $id
 * @property int                         $negotiation_group_faq_category_id
 * @property string                      $title
 * @property string                      $body
 * @property string                      $published_body
 * @property Carbon                      $published_at
 * @property Carbon                      $created_at
 * @property Carbon                      $updated_at
 * @property NegotiationGroupFaqCategory $negotiationGroupFaqCategory
 */
class NegotiationGroupFaq extends Model implements Sortable
{
    use SortableTrait;

    protected $casts = [
        'published_at' => 'datetime',
    ];

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

    public function negotiationGroupFaqCategory()
    {
        return $this->belongsTo(NegotiationGroupFaqCategory::class);
    }
}
