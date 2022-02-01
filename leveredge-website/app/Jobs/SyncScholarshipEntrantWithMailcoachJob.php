<?php

namespace App\Jobs;

use App\ScholarshipEntrant;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Redis\LimiterTimeoutException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class SyncScholarshipEntrantWithMailcoachJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $entrant;

    public $listId;

    public $tags;

    /**
     * Create a new job instance.
     *
     * @param Model $entrant
     * @param null $listId
     * @param array $tags
     */
    public function __construct(Model $entrant, $listId = null, $tags = [])
    {
        $this->entrant = $entrant;
        $this->listId  = $listId;
        $this->tags    = $tags;

        if (is_null($this->listId)) {
            $this->listId = config('services.mailcoach_email.scholarship_list_id');
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws LimiterTimeoutException
     */
    public function handle()
    {
        $config = config('services.mailcoach_email');

        $url = "{$config['url']}/email-lists/{$this->listId}/subscribers";

        Redis::throttle('scholarship-entrants')
            ->allow(200)
            ->every(60)
            ->then(function () use ($config, $url) {
                try {
                    $client = new Client();
                    $client->post($url, [
                        'headers' => [
                            'Authorization' => "Bearer {$config['token']}",
                        ],
                        'form_params' => [
                            'email'             => $this->entrant->email,
                            'first_name'        => $this->entrant->first_name,
                            'last_name'         => $this->entrant->last_name,
                            'skip_welcome_mail' => true,
                            'tags'              => $this->tags,
                        ],
                    ]);
                } catch (\Exception $e) {
                    Log::channel('single')->info($e->getMessage());
                }
            }, function () {
                // Could not obtain lock...

                return $this->release(60);
            });
    }
}
