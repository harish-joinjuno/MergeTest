<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $negotiation_group_id
 * @property Carbon $announced_on
 * @property string $body
 * @property string $published_body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read NegotiationGroup $negotiationGroup
 */
class NegotiationGroupAnnouncement extends Model
{
    protected $casts = [
        'announced_on' => 'date',
    ];

    public function negotiationGroup()
    {
        return $this->belongsTo(NegotiationGroup::class);
    }
}
