<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $mailchimp_automated_campaign_id
 * @property string $mailable_type
 * @property int $mailable_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read MailchimpAutomatedCampaign $mailchimpAutomatedCampaign
 */
class MailchimpAutomatedCampaignMailable extends Model
{
    public function mailable()
    {
        return $this->morphTo();
    }

    public function mailchimpAutomatedCampaign()
    {
        return $this->belongsTo(MailchimpAutomatedCampaign::class, 'mailchimp_automated_campaign_id');
    }
}
