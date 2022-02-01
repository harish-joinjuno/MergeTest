<?php

namespace App\Jobs;


use App\Notifications\ReadyToPaySlackNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ReadyToPayNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $type;

    public $claimUrl;

    /**
     * Create a new job instance.
     *
     * @param string $type
     * @param string $claimUrl
     */
    public function __construct(string $type, string $claimUrl)
    {
        $this->type     = $type;
        $this->claimUrl = $claimUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::route('slack', config('services.slack.ready_to_pay'))
            ->notify(new ReadyToPaySlackNotification($this->type, $this->claimUrl));
    }
}
