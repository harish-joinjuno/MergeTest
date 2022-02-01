<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FacebookAdMetric
 * @package App
 *
 * @property Carbon $date
 * @property string $campaign_name
 * @property string $campaign_id
 * @property string $ad_set_name
 * @property string $ad_set_id
 * @property string $ad_name
 * @property string $ad_id
 * @property int $unique_clicks
 * @property int $reach
 * @property int $impressions
 * @property float $frequency
 * @property float $cost
 * @method static orderByDesc(string $string)
 */
class FacebookAdMetric extends Model
{
    protected $fillable = [
         'date',
         'campaign_name',
         'campaign_id',
         'ad_set_name',
         'ad_set_id',
         'ad_name',
         'ad_id',
         'unique_clicks',
         'reach',
         'impressions',
         'frequency',
         'cost',
    ];
}
