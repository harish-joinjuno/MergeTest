<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NegotiationGroupUserExclusion
 * @package App
 * @property int $negotiation_group_id
 * @property int $user_id
 * @property-read $negotiationGroup
 * @property-read $user
 */
class NegotiationGroupUserExclusion extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function negotiationGroup()
    {
        return $this->belongsTo(NegotiationGroup::class);
    }
}
