<?php

namespace App\Jobs;

use App\Facades\Mailchimp;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateSubscriberInMailchimp implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        if (!app()->environment('production')) {
            return;
        }

        $data = [
            'FNAME'      => $this->user->first_name ?? '',
            'TYPE'       => $this->user->profile->immigration_status ?? '',
            'CODE'       => $this->user->referral_code ?? '',
            'UNI'        => $this->user->profile->university->name ?? '',
            'DEGREE'     => $this->user->profile->degree->name ?? '',
            'GRADYEAR'   => $this->user->profile->graduation_year ?? '',
            'REFERREDBY' => $this->user->referredBy->name ?? '',
            'G_UNI'      => $this->user->profile->gradUniversity->name ?? '',
            'G_DEGREE'   => $this->user->profile->gradDegree->name ?? '',
            'G_GRADYEAR' => $this->user->profile->grad_graduation_year ?? '',
        ];

        Mailchimp::subscribe($this->user->email, $data);
    }
}
