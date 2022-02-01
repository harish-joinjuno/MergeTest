<?php

namespace App\Mail;

use App\Payment;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AmazonGiftCardSent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $payment;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Payment $payment
     */
    public function __construct(User $user, Payment $payment)
    {
        $this->payment = $payment;
        $this->user    = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.amazon-gift-card.sent')
            ->subject('Your reward from LeverEdge')
            ->with('payment',$this->payment);
    }
}
