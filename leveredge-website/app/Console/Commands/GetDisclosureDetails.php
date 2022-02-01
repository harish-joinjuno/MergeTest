<?php

namespace App\Console\Commands;

use App\DisclosureDetail;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetDisclosureDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:disclosure-details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $alreadyReceivedResponsesCount = DisclosureDetail::whereResponseReceived(true)->whereNotNull('response')->count();

        if ($alreadyReceivedResponsesCount % 5 === 0 ) {
            $disclosureDetails = DisclosureDetail::whereNotNull('s3_url')
                ->whereNull('response')
                ->skip(0)
                ->take(5)
                ->get();

            Log::channel('disclosure_details')->info('Running command for ids ' . implode(',',$disclosureDetails->pluck('id')->toArray()));

            $disclosureDetails->each(function (DisclosureDetail $disclosureDetail) {
                try {
                    $client = new Client();
                    $response = $client->request('POST', 'http://ec2-52-3-224-32.compute-1.amazonaws.com:6800/schedule.json', [
                        'form_params' => [
                            'project' => 'disclosure_extractor',
                            'spider'  => 'ocr_function',
                            'id'      => $disclosureDetail->id,
                            's3_url'  => $disclosureDetail->s3_url,
                        ],
                    ]);
                    //TODO save response later
                } catch (\Exception $e) {
                    //TODO debugg error message
                }
            });
        }
    }
}
