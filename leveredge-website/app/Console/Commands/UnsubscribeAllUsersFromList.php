<?php

namespace App\Console\Commands;

use App\Facades\Mailchimp;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class UnsubscribeAllUsersFromList extends Command
{

    protected $signature = 'mailchimp:unsubscribe_all_users {listId : The list id of mailchimp}';

    protected $description = "Bulk unsubscribe users from mailchimp's list";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if (! $this->confirm("This will bulk unsubscribe all users from {$this->argument('listId')} list id. Confirm?")) {
            $this->output->success('Cancelling...');
            return;
        }

        $this->info("Searching for all users...\n\n");

        $users = User::all('email')
            ->pluck('email');

        $listId = $this->argument('listId');

        $this->info("Found {$users->count()} users \n\n");
        $randId = rand();
        $batch = Mailchimp::newBatch($randId);

        $progress = $this->output->createProgressBar($users->count());
        $progress->start();

        foreach($users as $index => $email) {
            Mailchimp::unsubscribeBatch($email, $listId, $batch, "op{$index}");

            $progress->advance();
        }

        $batch->execute();

        $progress->finish();

        $this->output->success('Done!');
    }
}
