<?php

namespace App\Console\Commands\BatchProcesses;

use App\MailingList\Campaigns\Credible\CredibleCompletedApplication;
use App\MailingList\Campaigns\Credible\CredibleReceivedPrelimQuotes;
use App\MailingList\Campaigns\Credible\CredibleRejectByLender;
use App\MailingList\Campaigns\Credible\CredibleRejectedByLenderFollowUp;
use App\MailingList\Campaigns\Credible\CredibleRejectedByLenderFollowUpWithCosigner;
use App\MailingList\Campaigns\Credible\CredibleRejectedByLenderWithCosigner;
use App\MailingList\Campaigns\Earnest\Graduate\EarnestGraduateReceivedQuotes;
use App\MailingList\Campaigns\Earnest\Graduate\EarnestGraduateRejectedByLender;
use App\MailingList\Campaigns\Earnest\Graduate\EarnestGraduateRejectedByLenderFollowUpEmails;
use App\MailingList\Campaigns\Earnest\Graduate\EarnestGraduateRejectedByLenderFollowUpWithCosigner;
use App\MailingList\Campaigns\Earnest\Graduate\EarnestGraduateRejectedByLenderWithCosigner;
use App\MailingList\Campaigns\Earnest\Graduate\EarnestGraduateSignedTheLoan;
use App\MailingList\Campaigns\Earnest\Graduate\EarnestGraduateSubmittedCompleteApplication;
use App\MailingList\Campaigns\Earnest\Refi\EarnestRefiRejectedByLender;
use App\MailingList\Campaigns\Earnest\Refi\EarnestRefiSignedTheLoan;
use App\MailingList\Campaigns\Earnest\Refi\EarnestRefiSignedTheLoanInOtherStates;
use App\MailingList\Campaigns\Earnest\Undergrad\EarnestUndergradReceivedQuotes;
use App\MailingList\Campaigns\Earnest\Undergrad\EarnestUndergradRejectedByLender;
use App\MailingList\Campaigns\Earnest\Undergrad\EarnestUndergradRejectedByLenderFollowUpEmails;
use App\MailingList\Campaigns\Earnest\Undergrad\EarnestUndergradRejectedByLenderFollowUpWithCosigner;
use App\MailingList\Campaigns\Earnest\Undergrad\EarnestUndergradRejectedByLenderWithCosigner;
use App\MailingList\Campaigns\Earnest\Undergrad\EarnestUndergradSignedTheLoan;
use App\MailingList\Campaigns\Earnest\Undergrad\EarnestUndergradSubmittedCompleteApplication;
use App\MailingList\Campaigns\LaurelRoadRefi\LaurelRoadRefiRejectedByLender;
use App\MailingList\Campaigns\LaurelRoadRefi\LaurelRoadRefiSignedTheLoan;
use App\MailingList\Campaigns\Splash\SplashSignedTheLoan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class PullMailchimpCampaignMembersList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp-campaigns:set-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $start = microtime(true);
        Cache::put('mailchimp_automated_campaign_users', app('mailchimp_automated_campaign_users'));
        $time = microtime(true) - $start;
        $this->output->writeln('<info>Finished pulling users, took - ' . $time . '</info>');
        $mailchimpCampaignsList = [
//            new EarnestGraduateSubmittedCompleteApplication(),
            new EarnestGraduateReceivedQuotes(),
            new EarnestGraduateRejectedByLender(),
            new EarnestGraduateSignedTheLoan(),
            new EarnestGraduateRejectedByLenderFollowUpEmails(),
            new EarnestGraduateRejectedByLenderWithCosigner(),
//            new EarnestGraduateRejectedByLenderFollowUpWithCosigner(),
//            new EarnestUndergradSubmittedCompleteApplication(),
            new EarnestUndergradReceivedQuotes(),
            new EarnestUndergradSignedTheLoan(),
            new EarnestUndergradRejectedByLender(),
            new EarnestUndergradRejectedByLenderFollowUpEmails(),
            new EarnestUndergradRejectedByLenderWithCosigner(),
//            new EarnestUndergradRejectedByLenderFollowUpWithCosigner(),
            new EarnestRefiSignedTheLoan(),
            new EarnestRefiSignedTheLoanInOtherStates(),
//            new EarnestRefiRejectedByLender(),
            new CredibleCompletedApplication(),
            new CredibleReceivedPrelimQuotes(),
            new CredibleRejectByLender(),
            new CredibleRejectedByLenderFollowUp(),
            new CredibleRejectedByLenderWithCosigner(),
//            new CredibleRejectedByLenderFollowUpWithCosigner(),
//            new LaurelRoadRefiSignedTheLoan(),
//            new LaurelRoadRefiRejectedByLender(),
            new SplashSignedTheLoan(),
        ];

        foreach ($mailchimpCampaignsList as $campaign) {
            $startCampaign = microtime(true);
            $campaign->getAll($this->output);
            $endCampaign = microtime(true) -  $startCampaign;
            $this->output->writeln('<info>Finished campaign {' . get_class($campaign) . '}, took - ' . $endCampaign . '</info>');
        }

        $this->output->comment(microtime(true) - $start);

        Cache::forget('mailchimp_automated_campaign_users');
    }
}
