<?php

namespace App\Http\Controllers;

use App\Jobs\ReportTestPrepPaymentAttemptedToFacebook;
use Illuminate\Http\Request;

class TestPrepPaymentTestController extends Controller
{
    public function show()
    {
        return view('payments.payments');
    }

    public function paymentInfo()
    {
        return view('payments.payment-info');
    }

    public function fail()
    {
        $this->dispatch(new ReportTestPrepPaymentAttemptedToFacebook);
        return view('payments.failed');
    }
}
