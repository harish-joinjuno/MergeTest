<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $quote
 * @property string $quote_author
 * @property string $logo
 *
 * @property int $partner_profile_id
 * @property-read PartnerProfile $partner_profile
 *
 * @property int $template_id
 * @property-read LandingPageTemplate $template
 *
 * @property array $properties
 * @property boolean $hide_medical
 * @property string $non_medical_section_title
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class LandingPage extends Model
{
    protected $casts = [
        'properties' => 'object',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function partner_profile()
    {
        return $this->belongsTo(PartnerProfile::class);
    }

    public function getUrl()
    {
        return url("/partner/{$this->slug}?grow={$this->partner_profile->user->referral_code}");
    }

    public function getPartnerReferralUrlAttribute()
    {
        return url("/p/{$this->slug}");
    }

    public function template()
    {
        return $this->belongsTo(LandingPageTemplate::class, 'template_id');
    }

    public function getNonMedicalSectionTitleAttribute($value)
    {
        if (is_null($value)) {
            return 'Loan Refinancing Benefits';
        }

        return $value;
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function ($landingPage) {
            $dynamicProperties = array_filter(array_keys($landingPage->attributes), function ($item) {
                return Str::startsWith($item, '_');
            });
            $properties = [];

            if ($dynamicProperties) {
                foreach ($dynamicProperties as $property) {
                    $properties[Str::replaceFirst('_','', $property)] = $landingPage->$property;
                    unset($landingPage->$property);
                }

                $landingPage->properties = $properties;
            }
        });
    }
}
