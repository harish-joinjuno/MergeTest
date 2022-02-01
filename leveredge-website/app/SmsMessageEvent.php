<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $sms_message_id
 * @property string $twilio_id
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property-read SmsMessage $smsMessage
 */
class SmsMessageEvent extends Model
{

    const STATUS_PENDING   = 'pending';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_SENT      = 'sent';

    public function smsMessage()
    {
        return $this->belongsTo(SmsMessage::class);
    }
}
