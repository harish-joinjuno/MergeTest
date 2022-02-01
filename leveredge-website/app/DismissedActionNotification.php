<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int     $user_id
 * @property int     $action_notification_id
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class DismissedActionNotification extends Model
{
    protected $fillable = [
        'user_id',
        'action_notification_id',
    ];

    public function getDismissedAtAttribute($value)
    {
        return $this->created_at;
    }
}
