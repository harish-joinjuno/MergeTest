<?php

namespace App\Console\Commands\ManageCrawlers;

use App\ClientRequest;
use Illuminate\Console\Command;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class FlagCrawlers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'juno:flag-crawlers {--all : Review all, including requests already flagged as crawler}';

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
        if ($this->option('all')) {
            $clientRequests = ClientRequest::all();
        } else {
            $clientRequests = ClientRequest::whereCrawler(false)->get();
        }
        $bar            = $this->output->createProgressBar(count($clientRequests));
        $bar->start();
        $crawlerDetect = new CrawlerDetect();
        foreach ($clientRequests as $clientRequest) {
            if ($crawlerDetect->isCrawler($clientRequest->user_agent)) {
                $clientRequest->crawler = true;
                $clientRequest->save();
            }
            $bar->advance();
        }
        $bar->finish();
        $this->info(PHP_EOL.'Done!');
        return 0;
    }
}
