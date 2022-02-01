<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MailchimpActivity
 * @package App
 *
 * @property int $id
 * @property int $user_id
 * @property string $action
 * @property string $campaign_id
 * @property Carbon $timestamp
 * @property Carbon $crated_at
 * @property Carbon $updated_at
 *
 * @property-read User $user;
 */
class MailchimpActivity extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'campaign_id',
        'timestamp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
