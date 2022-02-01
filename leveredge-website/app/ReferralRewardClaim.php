<?php

namespace App;

use App\Jobs\ReadyToPayNotificationJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $referral_program_user_id
 * @property string $reward
 * @property int $value
 * @property string $address_line_one
 * @property string $address_line_two
 * @property string $address_line_three
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read ReferralProgramUser $referralProgramUser
 */
class ReferralRewardClaim extends Model
{
    protected static function booted()
    {
        static::created(function ($referralRewardClaim) {
            dispatch(new ReadyToPayNotificationJob('Referral Reward Claim', url("nova/resources/referral-reward-claims/{$referralRewardClaim->id}")));
        });
    }

    public function getUser()
    {
        $this->referralProgramUser->user();
    }

    public function referralProgramUser()
    {
        return $this->belongsTo(ReferralProgramUser::class);
    }
}
