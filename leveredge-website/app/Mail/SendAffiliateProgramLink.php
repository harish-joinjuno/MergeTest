<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAffiliateProgramLink extends Mailable
{
    use Queueable, SerializesModels;

    protected $affiliate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($affiliate)
    {
        $this->affiliate = $affiliate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@leveredge.org','LeverEdge')
            ->subject('LeverEdge Referral Program Details')
            ->markdown('emails.affiliate.send_affiliate_program_link')
            ->with([
                'name' => $this->affiliate->name,
                'code' => $this->affiliate->code,
                'access_code' => $this->affiliate->access_code
            ]);
    }
}
