<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $cta_text
 * @property string $cta_link
 * @property string $foot_note_marker
 * @property array $notes_below_rates
 * @property string $internal_name
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read RateProperty[] $rateProperties
 * @property-read LandingPageTemplate[] $landingPageTemplates
 */
class Rate extends Model
{
    protected $casts = [
        'notes_below_rates' => 'array',
    ];

    protected $with = [
        'rateProperties',
    ];

    const GRADUATE_PAGE                                                                     = 3;
    const UNDERGRADUATE_PAGE                                                                = 4;
    const REFI_LOAN_DETAIL_PAGE                                                             = 1;

    const EARNEST_DEAL_DETAIL_PAGE_UNDERGRAD                                                = 8;
    const EARNEST_DEAL_DETAIL_PAGE_GRAD                                                     = 5;
    const EARNEST_REFI_WITH_REWARDS_PAGE                                                    = 6;
    const EARNEST_REFI_WITH_REWARDS_OTHER_STATES_PAGE                                       = 9;

    const LAUREL_ROAD_DEAL_DETAIL_PAGE_REFI                                                 = 7;

    public function rateProperties()
    {
        return $this->belongsToMany(RateProperty::class, 'rate_property_rate');
    }

    public function getTermTitleAttribute($value)
    {
        if (is_null($value)) {
            return 'Term';
        }

        return $value;
    }

    public function getAprTitleAttribute($value)
    {
        if (is_null($value)) {
            return 'APR';
        }

        return $value;
    }

    public function pageData($id)
    {
        return $this->rateProperties()->find($id);
    }
}
