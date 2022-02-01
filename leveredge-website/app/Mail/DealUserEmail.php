<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class DealUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->from('support@leveredge.org')
            ->subject('Complete LeverEdge Sign Up to access all LeverEdge Deals')
            ->markdown('emails.deals.user')->with([
                'user' => $this->user
            ]);
    }
}
