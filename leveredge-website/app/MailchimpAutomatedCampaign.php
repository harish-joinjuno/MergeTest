<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MailchimpAutomatedCampaign
 * @package App
 * @property string $name
 * @property array $endpoints
 * @property boolean $allow_multiple_emails
 * @property boolean $should_be_validated
 */
class MailchimpAutomatedCampaign extends Model
{
    const DOMESTIC_REFI_WELCOME_EMAIL_ID      = 47;
    const INTERNATIONAL_GROUP_21_22_ID        = 46;
    const DOMESTIC_GROUP_21_22_ID             = 45;
    const INTERNATIONAL_REFI_WELCOME_EMAIL_ID = 44;
    const BAR_PREP_WELCOME_EMAIL_ID           = 43;
    const AUTO_LOAN_WELCOME_EMAIL_ID          = 42;
    const NOT_ELIGIBLE_FOR_GBG_ID             = 35;
    const ELIGIBLE_FOR_GBG                    = 34;

    protected $casts = [
        'endpoints' => 'array',
    ];

    public function setEndpointsAttribute($value)
    {
        if ($value === "[]") {
            $this->attributes['endpoints'] = '[]';
        } else {
            $this->attributes['endpoints'] = json_encode($value);
        }
    }

    public function mailables()
    {
        return $this->hasMany(MailchimpAutomatedCampaignMailable::class, 'mailchimp_automated_campaign_id');
    }
}
