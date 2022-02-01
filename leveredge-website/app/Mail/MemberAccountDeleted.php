<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberAccountDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $deleteRequestId;

    /**
     * Create a new message instance.
     *
     * @param int $deleteRequestId
     */
    public function __construct(int $deleteRequestId)
    {
        $this->deleteRequestId = $deleteRequestId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Account Deleted!')
            ->view('emails.member-account-deleted');
    }
}
