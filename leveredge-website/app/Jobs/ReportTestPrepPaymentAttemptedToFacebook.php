<?php


namespace App\Jobs;


use App\Jobs\Abstracts\ReportEventToFacebook;

class ReportTestPrepPaymentAttemptedToFacebook extends ReportEventToFacebook
{

    protected function getEventInformation(): array
    {
        return [
            'category'  => 'test-prep-payment',
            'action'    => 'AddPaymentInfo',
            'label'     => 'test-prep-payment',
            'value'     => 0,
        ];
    }
}
