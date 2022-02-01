<?php

namespace App\Jobs;

use App\UserProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Redis\LimiterTimeoutException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class SyncMailchimpTagsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userProfile;

    /**
     * Create a new job instance.
     *
     * @param UserProfile $userProfile
     */
    public function __construct(UserProfile $userProfile)
    {
        $this->userProfile = $userProfile;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws LimiterTimeoutException
     */
    public function handle()
    {
        Redis::throttle('sync-tags')
            ->allow(50)
            ->every(2)
            ->then(function () {
                $this->userProfile->syncWithMailchimp();
            }, function () {
                return $this->release(10);
            });
    }
}
