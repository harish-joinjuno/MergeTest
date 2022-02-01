<?php

namespace App;

use App\Jobs\MailchimpAutomatedCampaignEmailJob;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MailchimpAutomatedCampaignUser
 * @package App
 * @property int $user_id
 * @property int $mailchimp_automated_campaign_id
 * @property boolean validated
 * @property User $user
 * @property MailchimpAutomatedCampaign $mailchimpAutomatedCampaign
 * @property Carbon $send_date
 * @property string $status
 * @property string $response
 */
class MailchimpAutomatedCampaignUser extends Model
{
    use SoftDeletes;

    const STATUS_PRE_DISPATCHING = 'pre dispatching';

    const STATUS_DISPATCHING = 'dispatching';

    const STATUS_CALL_SENT = 'API Call Sent';

    const STATUS_VALIDATED = 'validated';

    const STATUS_PENDING_VALIDATION = 'pending validation';

    const STATUS_CONFIRMED_BY_MAILCHIMP = 'confirmed by mailchimp';

    const STATUS_NOT_SENT_DUE_24_HOUR_LIMIT = 'not send due 24 hours limit';

    const STATUS_DELETED  = 'deleted';

    protected $casts = [
        'send_date' => 'date:Y-m-d',
    ];

    protected $fillable = [
        'user_id',
        'mailchimp_automated_campaign_id',
        'send_date',
        'validated',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mailchimpAutomatedCampaign()
    {
        return $this->belongsTo(MailchimpAutomatedCampaign::class);
    }

    public function send()
    {
        if (! $this->alreadySentEmail() || $this->mailchimpAutomatedCampaign->allow_multiple_emails) {
            if (! $this->mailchimpAutomatedCampaign->should_be_validated || $this->validated) {
                $alreadySendEmails = self::where('user_id',$this->user_id)
                    ->where('mailchimp_automated_campaign_id', $this->mailchimp_automated_campaign_id)
                    ->where('status',self::STATUS_CALL_SENT)
                    ->orderByDesc('id')->first();

                if (is_object($alreadySendEmails)) {
                    if ($this->mailchimpAutomatedCampaign->allow_multiple_emails && now()->diffInHours($alreadySendEmails->created_at, true) > 24) {
                        $this->sendAutomatedCampaignEmail();
                    } else {
                        $this->status = self::STATUS_NOT_SENT_DUE_24_HOUR_LIMIT;
                        $this->save();
                        try {
                            $this->delete();
                        } catch (\Exception $e) {
                            $this->response = $e->getMessage();
                            $this->save();
                        }
                    }
                } else {
                    $this->sendAutomatedCampaignEmail();
                }
            }
        }
    }

    public function alreadySentEmail()
    {
        return self::whereUserId($this->user_id)
            ->whereMailchimpAutomatedCampaignId($this->mailchimp_automated_campaign_id)
            ->whereStatus(self::STATUS_CALL_SENT)
            ->exists();
    }

    public function sendAutomatedCampaignEmail()
    {
        $this->status = self::STATUS_DISPATCHING;
        $this->save();
        dispatch(new MailchimpAutomatedCampaignEmailJob($this));
    }
}
