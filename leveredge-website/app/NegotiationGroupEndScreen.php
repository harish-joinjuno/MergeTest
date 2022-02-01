<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $negotiation_group_id
 * @property string $heading
 * @property string $description
 * @property string $cta_text
 * @property string $cta_link
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read NegotiationGroup $negotiationGroup
 * @property-read InfoCardElement[] infoCardElements
 */
class NegotiationGroupEndScreen extends Model
{
    public function negotiationGroup()
    {
        return $this->belongsTo(NegotiationGroup::class, 'negotiation_group_id');
    }

    public function infoCardElements()
    {
        return $this->morphMany(InfoCardElement::class, 'info_card');
    }
}
