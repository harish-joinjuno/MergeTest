<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoogleAdMetric
 * @package App
 * @property Carbon $date
 * @property string $campaign_name
 * @property string $campaign_id
 * @property string $ad_group_name
 * @property string $ad_group_id
 * @property string $ad_group_criterion_id
 * @property string $ad_group_criterion_keyword_text
 * @property int $ad_group_criterion_keyword_match_type
 * @property int $impressions
 * @property int $clicks
 * @property float $cost
 */
class GoogleAdMetric extends Model
{
    protected $fillable = [
        'date',
        'campaign_name',
        'campaign_id',
        'ad_group_name',
        'ad_group_id',
        'ad_group_criterion_id',
        'ad_group_criterion_keyword_text',
        'ad_group_criterion_keyword_match_type',
        'impressions',
        'clicks',
        'cost',
    ];
}
