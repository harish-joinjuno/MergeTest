<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $type
 * @property boolean $show_referrals_list
 * @property-read Collection|ContractTypeMetric $contractTypeMetrics
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ContractType extends Model
{
    const TYPE_CAMPUS_AMBASSADOR    = 'Campus Ambassador Contract';
    const TYPE_CAMPUS_AMBASSADOR_ID = 1;

    protected $fillable = ['type'];

    public function partnerProfiles()
    {
        return $this->hasMany(PartnerProfile::class);
    }

    public function contractTypeMetrics()
    {
        return $this->hasMany(ContractTypeMetric::class);
    }

    public function calculateEarnedAmount(User $user)
    {
        return $this->contract_type_definition ? (new $this->contract_type_definition)->calculateEarnedAmount($user) : null;
    }
}
