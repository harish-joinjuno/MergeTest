<?php


namespace App\Jobs\CompleteFlow;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarkBarPrepAppStarted
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function handle()
    {
        $user    = user();
        $profile = $user->profile;

        $profile->bar_prep_app_started = true;
        $profile->save();
    }
}
