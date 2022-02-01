<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ScholarshipEmail
 * @package App
 * @property int $id
 * @property string $internal_name
 * @property int $scholarship_id
 * @property int $marketing_email_template_id
 * @property Scholarship $scholarship
 * @property MarketingEmailTemplate $marketingEmailTemplate
 * @property string $trigger_type
 * @property int $days_after_entrant_joined
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ScholarshipEmail extends Model
{
    const TRIGGER_INSTANTLY             = 'instantly';
    const TRIGGER_AFTER_X_DAYS          = 'after x days';
    const TRIGGER_INSTANTLY_IF_FIRST    = 'instantly if first';
    const TRIGGER_AFTER_X_DAYS_IF_FIRST = 'after x days if first';

    const AVAILABLE_TRIGGERS            = [
        self::TRIGGER_INSTANTLY             => self::TRIGGER_INSTANTLY,
        self::TRIGGER_AFTER_X_DAYS          => self::TRIGGER_AFTER_X_DAYS,
        self::TRIGGER_INSTANTLY_IF_FIRST    => self::TRIGGER_INSTANTLY_IF_FIRST,
        self::TRIGGER_AFTER_X_DAYS_IF_FIRST => self::TRIGGER_AFTER_X_DAYS_IF_FIRST,
    ];

    public function scholarship(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Scholarship::class);
    }

    public function marketingEmailTemplate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MarketingEmailTemplate::class);
    }
}
