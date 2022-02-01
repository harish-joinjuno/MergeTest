<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GbgReport
 * @package App
 * @property int $id
 * @property int $policy_number
 * @property int $individual_id
 * @property string $type
 * @property string $policy_holder
 * @property Carbon $policy_start_date
 * @property Carbon $policy_end_date
 * @property string $status
 * @property string $product
 * @property string $agent_name
 * @property string $premium_amount_currency
 * @property float $premium_amount
 * @property string $outstanding_balance_currency
 * @property float $outstanding_balance
 * @property int $access_the_deal_id
 * @property-read AccessTheDeal $accessTheDeal
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class GbgReport extends Model
{
    public function accessTheDeal(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AccessTheDeal::class);
    }

    public function getPotentialMatches(): \Illuminate\Support\Collection
    {
        $names = explode(' ', $this->policy_holder);

        if (count($names) == 0) {
            return collect();
        }

        $query = User::whereHas('accessTheDeals',function($query) {
            $query->where('deal_id',Deal::DEAL_INTERNATIONAL_HEALTH_INSURANCE_20_ID);
        });
        foreach ($names as $name) {
            $query = $query->where('name','like','%' . $name . '%');
        }

        return $query->get();
    }
}
