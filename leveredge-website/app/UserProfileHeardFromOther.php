<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserProfileHeardFromOther
 * @package App
 *
 * @property int $id
 * @property int $user_profile_id
 * @property-read UserProfile $userProfile
 *
 * @property string $name
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static whereUserProfileId(int $id)
 */
class UserProfileHeardFromOther extends Model
{
    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'id');
    }
}
