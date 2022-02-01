<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int     $id
 * @property string  $email
 * @property boolean $has_unsubscribed
 * @property string  $reason
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class MarketingEmailUnsubscribe extends Model
{
    const USER_INITIATED_UNSUBSCRIBE = 'User Initiated';
    const HARD_BOUNCE_UNSUBSCRIBE    = 'Hard Bounce';
    const SOFT_BOUNCE_UNSUBSCRIBE    = 'Soft Bounce';
    const COMPLAINT_UNSUBSCRIBE      = 'Complaint';

    const REASONS = [
        self::USER_INITIATED_UNSUBSCRIBE,
        self::HARD_BOUNCE_UNSUBSCRIBE,
        self::SOFT_BOUNCE_UNSUBSCRIBE,
        self::COMPLAINT_UNSUBSCRIBE
    ];

    protected $fillable = [
        'email',
        'has_unsubscribed',
        'reason'
    ];

    protected $casts = [
        'has_unsubscribed' => 'boolean'
    ];
}
