<?php

namespace App\Listeners;

use App\Events\ScholarshipEntrantCreated;
use App\Jobs\SendMarketingEmails as SendMarketingEmailsJob;
use App\MarketingEmail;
use App\MarketingEmailUnsubscribe;
use App\ScholarshipEmail;
use App\ScholarshipEntrant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ScheduleMarketingEmailsForScholarshipEntrant implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ScholarshipEntrantCreated  $event
     * @return void
     */
    public function handle(ScholarshipEntrantCreated $event)
    {
        $scholarshipEntrant = $event->scholarshipEntrant;

        foreach ($scholarshipEntrant->scholarship->scholarshipEmails as $scholarshipEmail) {
            $marketingEmail                              = new MarketingEmail();
            $marketingEmail->marketing_email_template_id = $scholarshipEmail->marketing_email_template_id;
            $marketingEmail->name                        = $scholarshipEntrant->first_name;
            $marketingEmail->email_address               = $scholarshipEntrant->email;
            $marketingEmail->utm_source                  = 'email';
            $marketingEmail->utm_campaign                = 'scholarship';


            if ($scholarshipEmail->trigger_type == ScholarshipEmail::TRIGGER_INSTANTLY
                || $scholarshipEmail->trigger_type == ScholarshipEmail::TRIGGER_INSTANTLY_IF_FIRST) {

                if ($scholarshipEmail->trigger_type == ScholarshipEmail::TRIGGER_INSTANTLY_IF_FIRST
                    && ScholarshipEntrant::where('email',$scholarshipEntrant->email)->count() > 1) {
                    continue;
                }

                $marketingEmail->send_date = now();

                if (! MarketingEmailUnsubscribe::whereEmail($marketingEmail->email_address)->exists()) {
                    $marketingEmail->setStatus('Job dispatched');
                    dispatch(new SendMarketingEmailsJob($marketingEmail));
                } else {
                    $marketingEmail->setStatus(MarketingEmail::MAIL_UNSUBSCRIBED);
                }
            }

            if ($scholarshipEmail->trigger_type == ScholarshipEmail::TRIGGER_AFTER_X_DAYS
                || $scholarshipEmail->trigger_type == ScholarshipEmail::TRIGGER_AFTER_X_DAYS_IF_FIRST ) {

                if ($scholarshipEmail->trigger_type == ScholarshipEmail::TRIGGER_AFTER_X_DAYS_IF_FIRST
                    && ScholarshipEntrant::where('email',$scholarshipEntrant->email)->count() > 1) {
                    continue;
                }

                $marketingEmail->send_date = now()->addDays($scholarshipEmail->days_after_entrant_joined);
            }

            $marketingEmail->save();
        }

        // Send the emails that need to be sent instantly
    }
}
