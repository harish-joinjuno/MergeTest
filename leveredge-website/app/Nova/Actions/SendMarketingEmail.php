<?php

namespace App\Nova\Actions;

use App\Jobs\SendMarketingEmails as SendMarketingEmailsJob;
use App\MarketingEmailUnsubscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SendMarketingEmail extends Action
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        $models->load('marketingEmailTemplate');

        foreach ($models as $marketingEmail) {
            if (! MarketingEmailUnsubscribe::whereEmail($marketingEmail->email_address)->exists()) {
                $marketingEmail->setStatus('Job dispatched');
                dispatch(new SendMarketingEmailsJob($marketingEmail));
            }
        }
    }

    public function fields()
    {
        return [];
    }
}
