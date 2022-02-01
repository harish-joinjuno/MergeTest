<?php

namespace App\Console\Commands;

use App\Jobs\GetMailchimpActivityJob;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use MailchimpMarketing\ApiClient;


class PullMailchimpActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:mailchimp-activities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull mailchimp activities for all available members';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $progressBar = $this->output->createProgressBar(User::count());
        User::orderBy('id')
            ->chunk(60, function ($users) use ($progressBar) {
                $users->each(function (User $user) {
                    dispatch(new GetMailchimpActivityJob($user));
                });

                $progressBar->advance(60);
            });

        $progressBar->finish();
    }
}
