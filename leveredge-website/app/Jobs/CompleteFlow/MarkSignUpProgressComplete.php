<?php

namespace App\Jobs\CompleteFlow;


use App\Events\UserProfileCompleted;
use App\UserProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarkSignUpProgressComplete
{
    use Dispatchable;
    use SerializesModels;

    public function handle()
    {
        $user    = user();
        $profile = $user->profile;

        $profile->signup_progress = UserProfile::SIGNUP_PROGRESS_COMPLETED;
        $profile->save();
        event(new UserProfileCompleted($user));
    }
}
