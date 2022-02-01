<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $contract_type_id
 * @property int $partner_type_id
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read ContractType $contractType
 * @property-read PartnerType $partnerType
 * @property-read User $user
 */
class PartnerProfile extends Model
{
    protected $fillable = [
        'contract_type_id', 'partner_type_id', 'user_id',
    ];

    /** @deprecated */
    public function contract_type()
    {
        return $this->belongsTo(ContractType::class);
    }

    public function contractType()
    {
        return $this->belongsTo(ContractType::class);
    }

    /** @deprecated */
    public function partner_type()
    {
        return $this->belongsTo(PartnerType::class);
    }

    public function partnerType()
    {
        return $this->belongsTo(PartnerType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** @deprecated */
    public function landing_pages()
    {
        return $this->hasMany(LandingPage::class);
    }

    public function landingPages()
    {
        return $this->hasMany(LandingPage::class);
    }

    public function isCampusAmbassador(): bool
    {
        return $this->partnerType->type === PartnerType::TYPE_CAMPUS_AMBASSADOR && $this->contractType->type ===  ContractType::TYPE_CAMPUS_AMBASSADOR;
    }
}
