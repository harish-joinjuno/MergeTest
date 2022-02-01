<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $url
 * @property string $utm_source
 * @property string $utm_campaign
 * @property string $utm_term
 * @property string $utm_content
 * @property string $notes
 * @property int    $hubspot_deal_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TrackedLink extends Model
{
    protected $fillable = [
        'url',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'hubspot_deal_id',
        'notes'
    ];

    protected $appends = [
        'tracked_url'
    ];

    public function getTrackedUrlAttribute()
    {
        return addUtmCodes($this->attributes['url'], $this);
    }
}
