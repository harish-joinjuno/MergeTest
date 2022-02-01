<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Redis\LimiterTimeoutException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use MailchimpMarketing\ApiClient;
use Illuminate\Support\Facades\Redis;

class GetMailchimpActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    private $mailchimpClient;

    /**
     * Create a new job instance.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user            = $user;
        $this->mailchimpClient = new ApiClient();
        $this->mailchimpClient->setConfig([
            'apiKey' => config('services.mailchimp.api_key'),
            'server' => config('services.mailchimp.server_prefix'),
        ]);
    }

    public function tags()
    {
        return ['mailchimp-activity', 'mailchimp-activity-user:' . $this->user->id];
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws LimiterTimeoutException
     */
    public function handle()
    {
        Redis::throttle('get-mailchimp-activity')->allow(60)->every(60)->then(function () {
            try {
                $response = $this->mailchimpClient->lists->getListMemberActivity(config('services.mailchimp.default_list_id'), md5($this->user->email));

                if (count($response->activity)) {
                    foreach ($response->activity as $activity) {
                        $data = [
                            'campaign_id' => $activity->campaign_id,
                            'action'      => $activity->action,
                            'timestamp'   => $activity->timestamp,
                        ];
                        $this->user->mailchimpActivity()->updateOrCreate($data,$data);
                    }
                }
            } catch (\Exception $e) {
                $message = $e->getMessage() . ' For user ID - ' . $this->user->id;
                Log::channel('mailchimp_activity')->debug($message);
            }
        }, function () {
            // Could not obtain lock...

            return $this->release(60);
        });
    }
}
