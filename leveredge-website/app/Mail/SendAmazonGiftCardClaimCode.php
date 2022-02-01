<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAmazonGiftCardClaimCode extends Mailable
{
    use Queueable, SerializesModels;

    public $claimCode;

    protected $viewType;

    /**
     * Create a new message instance.
     *
     * @param string $claimCode
     * @param string $view
     */
    public function __construct(string $claimCode, string $view)
    {
        $this->claimCode = $claimCode;
        $this->viewType  = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.amazon.gift-cards.' . $this->viewType);
    }
}
