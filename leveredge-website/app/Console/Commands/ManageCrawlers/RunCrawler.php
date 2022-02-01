<?php

namespace App\Console\Commands\ManageCrawlers;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class RunCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run-crawler {project} {crawler}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an API Call to run a crawler';

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
        $project = $this->argument('project');
        $crawler = $this->argument('crawler');

        $client  = new Client();
        $client->post('http://ec2-52-3-224-32.compute-1.amazonaws.com:6800/schedule.json',
            [
                'form_params' =>
                    [
                        'project' => $project,
                        'spider'  => $crawler,
                    ],
            ]
        );
    }
}
