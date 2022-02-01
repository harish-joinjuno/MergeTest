<?php

namespace App\Listeners;

use App\Events\CampusAmbassadorTaskCompleted;
use App\Notifications\TaskCompletedNotification;
use App\Role;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;
use Illuminate\Support\Facades\DB;

class NotifyTaskCompletedToAdminListener implements ShouldQueue
{
    public function handle(CampusAmbassadorTaskCompleted $event)
    {
        $completedTask = $event->completedTask;

        $adminUsers = User::whereIn('email', [
            'nikhil@leveredge.org',
            'shehzan.maredia@duke.edu',
        ])->get();

        $adminUsers->each(function (User $user) use ($completedTask) {
            $user->notify(new TaskCompletedNotification($completedTask));
        });
    }
}
