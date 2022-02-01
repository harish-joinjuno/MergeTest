<?php

namespace App\Console;

use App\Jobs\ClearHashedEmails;
use App\Jobs\MatchClaimsToLoans;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Laravel\Nova\Trix\PruneStaleAttachments;

class Kernel extends ConsoleKernel
{
    protected $commands = [];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('horizon:snapshot')
            ->everyFiveMinutes()
            ->thenPingIf(config('services.envoyer.horizon_snapshot'), config('services.envoyer.horizon_snapshot'));

        $schedule->call(function () {
            (new PruneStaleAttachments)();
        })
            ->daily()
            ->thenPingIf(config('services.envoyer.prune_stale_nova_attachments'), config('services.envoyer.prune_stale_nova_attachments'));

        $schedule->command('send:marketing-emails')
            ->dailyAt('13:00')
            ->timezone('America/New_York');

        $schedule->command('clear:unused-files')
            ->weekly();

        $schedule->command('mailchimp-campaigns:set-users')
            ->dailyAt('15:00')
            ->timezone('America/New_York');

        $schedule->command('send:laurel-road-full-members')
            ->weeklyOn(1,'10:00')
            ->timezone('America/New_York');

        $schedule->command('match-claims-to-loans')
            ->hourly();
        $schedule->command('get-metrics:splash')
            ->hourly();
        $schedule->command('get-metrics:earnest')
            ->hourly();
        $schedule->command('get-metrics:google-ads')
            ->hourly();
        $schedule->command('compute-metrics:revenue')
            ->hourly();
        $schedule->command('assign-analytics-source')
            ->everyFifteenMinutes();
        $schedule->command('set-estimated-loan-amounts')
            ->twiceDaily();
        $schedule->command('replace-zero-with-null-for-amounts')
            ->hourly();

//        $schedule->command('prune-client-requests')
//            ->dailyAt('2:00')
//            ->timezone('America/New_York');

        $schedule->command('juno:identify-bots')
            ->hourly();

        // This is the Instagram Crawler
        $schedule->command('run-crawler instagram profile_monitor')
            ->dailyAt('2:00')
            ->timezone('America/New_York');

        // This is the Career One Stop Scholarships Crawler
        $schedule->command('run-crawler careeronestop careeronestop_data_extractor')
            ->dailyAt('2:30')
            ->timezone('America/New_York');


        $schedule->command('juno:expand-disclosure-detail-response')
            ->hourly();


//        $schedule->command('send:hashed-emails')
//            ->dailyAt('12:00')
//            ->timezone('America/New_York');

//        $schedule->job(new ClearHashedEmails())
//            ->dailyAt('14:00')
//            ->timezone('America/New_York');

        $schedule->command('pull:mailchimp-activities')
            ->dailyAt('3:00')
            ->timezone('America/New_York');

        $schedule->command('partners:update-reward-availability')
            ->monthlyOn(7);

        $schedule->command('get:disclosure-details')
            ->everyThreeMinutes();

        $schedule->command('mailchimp:pull-campaigns')
            ->dailyAt('4:00')
            ->timezone('America/New_York');

        $schedule->command('mailchimp:pull-list-reports')
            ->dailyAt('5:00')
            ->timezone('America/New_York');

        $schedule->command('general-scholarships:prune')
            ->dailyAt('1:00')
            ->timezone('America/New_York');

        $schedule->command('notification:lrc-likely-payable-excluded-paid-once')->everyMinute();

        $schedule->command('notification:lrc-likely-payable-paid-once')->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
