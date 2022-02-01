<?php

namespace App\Http\Controllers;

use App\FederalLoanTrackerEmail;
use Illuminate\Http\Request;

class FederalLoanReminderController extends Controller
{
    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        $federalLoanTrackerEmail            = new FederalLoanTrackerEmail();
        $federalLoanTrackerEmail->client_id = getClientId();
        $federalLoanTrackerEmail->name      = $validatedData['name'];
        $federalLoanTrackerEmail->email     = $validatedData['email'];
        $federalLoanTrackerEmail->save();

        return response()->json([],200);
    }
}
