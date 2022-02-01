<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property array $required_properties
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Rate[] $rates
 * @property-read Rate[] $altRates
 * @property-read FaqGroup[] $faqGroups
 */
class LandingPageTemplate extends Model
{
    protected $casts = [
        'required_properties' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($landingPageTemplate) {
            $landingPageTemplate->slug = Str::slug($landingPageTemplate->name);
        });
    }

    public function rates()
    {
        return $this->belongsToMany(Rate::class, 'landing_page_template_rate');
    }

    public function altRates()
    {
        return $this->belongsToMany(Rate::class, 'landing_page_template_alt_rate');
    }

    public function faqGroups()
    {
        return $this->belongsToMany(FaqGroup::class, 'landing_page_template_faq_group');
    }
}
