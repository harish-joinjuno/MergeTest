<?php

namespace App\Mail;

use App\Affiliate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DownloadCompleteGuideToStudentLoansBusinessSchool extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance
     *
     * DownloadCompleteGuideToStudentLoansBusinessSchool constructor.
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('support@leveredge.org', 'LeverEdge')
            ->subject('Guide to Student Loans for Business School')
            ->markdown('emails.ad.download_guide_to_student_loans_business_school');
    }
}
