<?php

namespace App\Console\Commands\Imports;

use App\InstagramMetric;
use Aws\Psr16CacheAdapter;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;
use Symfony\Component\DomCrawler\Crawler;


class InstagramMetricScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:instagram';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap Instagram metrics';

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
     * @return void
     */
    public function handle()
    {
        $content = file_get_contents('https://www.instagram.com/juno_join/');
        preg_match('/\d+,\d+\sFollowers\,\s\d+\sFollowing\,\s\d+\sPosts/', $content, $matches);
        if (count($matches)) {
            $data = explode(' ', $matches[0]);

            InstagramMetric::create([
                'followers_count' => (int)str_replace(',','',$data[0]),
                'following_count' => (int)str_replace(',','',$data[2]),
                'posts_count'     => (int)str_replace(',','',$data[4]),
            ]);
        }
    }
}
