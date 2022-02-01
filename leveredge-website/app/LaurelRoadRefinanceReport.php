<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LaurelRoadRefinanceReport
 * @package App
 * @property int $partner_org_id
 * @property string $partner_org_name
 * @property float $app_amount
 * @property string $url_upcase
 * @property string $los_stage
 * @property bool $cosigner_flag
 * @property Carbon $closing_date
 * @property bool $resident_flag
 * @property Carbon $rates_publish_date
 * @property Carbon $hard_pull_at
 * @property int $loan_term
 * @property string $loan_rate_type
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property float $amount_waterfall
 * @property string $degree
 * @property string $med_specialty
 * @property float $full_amount
 * @property string $discount_partner
 * @property string $discount_camaign_description
 * @property string $school
 * @property int $access_the_deal_id
 * @property Carbon $application_date
 * @property int id
 */
class LaurelRoadRefinanceReport extends Model
{
    protected $casts = [
        'application_date'   => 'date',
        'closing_date'       => 'date',
        'rates_publish_date' => 'date',
    ];

    public function getPotentialAccessTheDealRecords($amountSensitivity = 100, $daysSensitivity = 1)
    {
        return AccessTheDeal::with(['user.profile','user.negotiationGroupUsers'])
            ->whereDate('created_at','<=',$this->application_date)
            ->whereDate('created_at','>=',$this->application_date->subDays($daysSensitivity))
            ->where('deal_id',14)
            ->where('loan_status_id',1)
            ->whereHas('user',function($query) use ($amountSensitivity) {
                $query->whereHas('negotiationGroupUsers',function($query) use ($amountSensitivity) {
                    $query->where('amount','>=',$this->app_amount - $amountSensitivity)
                   ->where('amount','<=',$this->app_amount + $amountSensitivity)
                   ->where('academic_year_id',1);
                })->whereDoesntHave('accessTheDeals',function($query) {
                    $query->where('loan_status_id',8)
                        ->whereHas('deal',function($query) {
                            $query->where('deal_type_id',4);
                        });
                });
            })
            ->get();
    }

    public function setHardPullAtAttribute($value)
    {
        if ($value) {
            $datetime = substr($value,0, 9);
            $day      = substr($datetime, 0, 2);
            $month    = strtolower(substr($datetime, 2, 3));
            $year     = substr($datetime, 5, 4);

            $date = Carbon::createFromFormat('d-M-Y', "{$day}-{$month}-{$year}");

            $this->attributes['hard_pull_at'] = $date->format('Y-m-d');
        }
    }
}
