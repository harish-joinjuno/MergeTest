<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $cta_text
 * @property string $cta_link
 * @property string $icon
 * @property string $notification_style
 * @property string $visibility_rule
 * @property string $dismissable_rule
 * @property int    $sort_order
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ActionNotification extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name'  => 'sort_order',
        'sort_when_creating' => true,
    ];

    public $appends = [
        'dismissable',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }

    public function dismissedNotification()
    {
        return $this->belongsTo(DismissedActionNotification::class, 'action_notification_id');
    }

    public function isVisibleTo(User $user)
    {
        if (class_exists($this->visibility_rule)) {
            if (class_exists($this->dismissable_rule)) {
                if (call_user_func($this->dismissable_rule . '::passes', $user, $this)) {
                    return call_user_func($this->visibility_rule . '::passes', $user, $this);
                }

                return false;
            }

            return call_user_func($this->visibility_rule . '::passes', $user, $this);
        }

        return false;
    }

    public function getDismissableAttribute($value)
    {
        return (boolean)! empty($this->dismissable_rule);
    }
}
