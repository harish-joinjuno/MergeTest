<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $type
 * @property-read Collection|PartnerProfile $partnerProfile
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PartnerType extends Model
{
    const TYPE_CAMPUS_AMBASSADOR    = 'Campus Ambassador';
    const TYPE_CAMPUS_AMBASSADOR_ID = 1;

    protected $fillable = ['type'];

    public function partnerProfiles()
    {
        return $this->hasMany(PartnerProfile::class);
    }
}
