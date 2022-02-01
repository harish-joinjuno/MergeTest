<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class LaurelRoadEmails extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->subject("Emails and Access The Deals IDs of LeverEdge Members as of " . date('Y-m-d H:i:s'))
            ->replyTo('nikhil@joinjuno.com')
            ->markdown('emails.laurel_road_emails')
            ->attach(storage_path($this->filePath));
    }
}
