<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int         $id
 * @property int $marketing_email_template_id
 * @property string|null $name
 * @property-read string|null $first_name
 * @property string      $email_address
 * @property string|null $status
 * @property int|null    $open
 * @property int|null    $click
 * @property json|null   $fields
 * @property Carbon      $send_date
 * @property string      $utm_source
 * @property string      $utm_campaign
 * @property string      $utm_medium
 * @property string      $utm_term
 * @property string      $utm_content
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 * @property-read $marketingEmailTemplate
 */
class MarketingEmail extends Model
{
    const MAIL_SENT             = 'Sent';
    const MAIL_UNSUBSCRIBED     = 'User already unsubscribed';
    const STATUS_JOB_DISPATCHED = 'Job dispatched';

    const MAIL_STATUSES = [
        'Sent'           => self::MAIL_SENT,
        'Unsubscribed'   => self::MAIL_UNSUBSCRIBED,
        'Job Dispatched' => self::STATUS_JOB_DISPATCHED,
    ];

    protected $fillable = [
        'marketing_email_template_id',
        'name',
        'email_address',
        'send_date',
        'status',
        'open',
        'click',
        'utm_source',
        'utm_campaign',
        'utm_medium',
        'utm_term',
        'utm_content',
        'fields',
    ];

    protected $casts = [
        'fields' => 'object',
    ];

    protected $dates = [
        'send_date',
    ];

    public function marketingEmailTemplate()
    {
        return $this->belongsTo(MarketingEmailTemplate::class);
    }

    public function getFirstNameAttribute()
    {
        return $this->name;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();
    }
}
