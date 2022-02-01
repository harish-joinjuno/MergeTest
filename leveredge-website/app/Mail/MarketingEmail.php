<?php

namespace App\Mail;

use App\MarketingEmail as MarketingEmailModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class MarketingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $marketingEmail;

    private $mailSubject;

    public function __construct(MarketingEmailModel $marketingEmail, $subject)
    {
        $this->marketingEmail     = $marketingEmail;
        $this->mailSubject        = $subject;
    }

    public function build()
    {
        return $this
            ->from('scholarships@leveredge.org','Chris Abkarians')
            ->subject($this->mailSubject)
            ->markdown("emails.marketing-email-templates.{$this->marketingEmail->marketingEmailTemplate->slug}");
    }
}
