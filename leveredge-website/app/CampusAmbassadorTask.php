<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * Class CampusAmbassadorTask
 * @package App
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $task_recurrence
 * @property integer $task_completion_tracking
 * @property integer $payment_type
 * @property integer $fixed_payment_amount
 * @property integer $task_completion_redirect
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CampusAmbassadorTask extends Model implements Sortable
{
    use SoftDeletes;
    use SortableTrait;

    const TASK_RECURRENCE_NONE      = 1;
    const TASK_RECURRENCE_RECURRING = 2;

    const TASK_COMPLETION_TRACKING_MANUAL    = 1;
    const TASK_COMPLETION_TRACKING_AUTOMATIC = 2;

    const PAYMENT_TYPE_FIXED  = 1;
    const PAYMENT_TYPE_HOURLY = 2;
    const PAYMENT_TYPE_NONE   = 3;

    const HOURLY_RATE = 15;

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

    /** @deprecated */
    public function completedBy()
    {
        $relation = $this->belongsToMany(User::class);

        $relation
            ->withPivot([
                'amount',
                'ambassador_notes',
                'admin_notes',
                'payment_completed',
            ])
            ->withTimestamps();

        return $relation;
    }

    public function calculatePaymentAmount(int $hoursWorked = null)
    {
        if ($this->payment_type == self::PAYMENT_TYPE_FIXED) {
            return $this->fixed_payment_amount;
        }

        if ($this->payment_type == self::PAYMENT_TYPE_HOURLY) {
            return ceil(($hoursWorked ?? 0) * self::HOURLY_RATE);
        }

        return 0;
    }
}
