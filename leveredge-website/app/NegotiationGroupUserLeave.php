<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NegotiationGroupUserLeave
 * @package App
 *
 * @property int $id
 * @property int $user_id
 * @property-read User $user
 *
 * @property int $negotiation_group_user_id
 * @property-read NegotiationGroupUser $negotiationGroupUser
 *
 * @property string $reason
 */
class NegotiationGroupUserLeave extends Model
{
    const REASONS = [
        "I am not interested in the deal",
        "I don't need a loan next year",
        "My reason is not listed here",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function negotiationGroupUser()
    {
        return $this->belongsTo(NegotiationGroupUser::class, 'negotiation_group_user_id');
    }
}
