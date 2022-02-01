<?php

namespace App\Jobs;

use App\Facades\Mailchimp;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddTagInMailchimp implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $user;
    public $tag;

    public function __construct(User $user, $tag)
    {
        $this->user = $user;
        $this->tag  = $tag;
    }

    public function handle()
    {
        $tag = [
            'name'   => $this->tag,
            'status' => 'active',
        ];

        Mailchimp::addTags($this->user->email, [$tag]);
    }
}
