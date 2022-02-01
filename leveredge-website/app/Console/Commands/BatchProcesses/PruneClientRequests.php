<?php

namespace App\Console\Commands\BatchProcesses;

use App\ClientRequest;
use Illuminate\Console\Command;

class PruneClientRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prune-client-requests';

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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ClientRequest::whereDate('created_at','<',now()->subDays(90))->delete();
    }
}
