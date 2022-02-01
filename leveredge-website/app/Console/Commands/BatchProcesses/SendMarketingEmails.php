<?php

namespace App\Console\Commands\BatchProcesses;

use App\Jobs\SendMarketingEmails as SendMarketingEmailsJob;
use App\MarketingEmail;
use App\MarketingEmailUnsubscribe;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendMarketingEmails extends Command
{
    protected $signature = 'send:marketing-emails';

    protected $description = 'Send marketing emails';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $marketingEmails = MarketingEmail::whereNull('status')
            ->whereSendDate(Carbon::now()->format('Y-m-d'))
            ->with('marketingEmailTemplate')
            ->get();

        foreach ($marketingEmails as $marketingEmail) {
            if (! MarketingEmailUnsubscribe::whereEmail($marketingEmail->email_address)->exists()) {
                $marketingEmail->setStatus('Job dispatched');
                dispatch(new SendMarketingEmailsJob($marketingEmail));
            } else {
                $marketingEmail->setStatus(MarketingEmail::MAIL_UNSUBSCRIBED);
            }
        }
    }
}
