<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $user_id
 * @property string $twilio_id
 * @property bool $incoming
 * @property string $from
 * @property string $to
 * @property string $body
 * @property array $media
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read User $user
 * @property-read Collection|SmsMessageEvent[] $events
 */
class SmsMessage extends Model
{
    use SoftDeletes;

    protected $casts = [
        'incoming' => 'bool',
        'media'    => 'array',
        'created_at' => 'date:Y-m-d H:i:s'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events()
    {
        return $this->hasMany(SmsMessageEvent::class);
    }
}
