<?php

namespace App\Http\Controllers\Admin;

use App\AccessTheDeal;
use App\DealStatus;
use App\GbgReport;
use App\Http\Controllers\Controller;
use App\Imports\GbgReportImport;
use App\Imports\State\GbgImportState;
use Illuminate\Http\Request;

class GbgImportController extends Controller
{
    public function index()
    {
        $unmatchedReports = GbgReport::whereNull('access_the_deal_id')->get();

        return view('admin.gbg.import.index')->with(compact('unmatchedReports'));
    }

    public function import(Request $request)
    {
        (new GbgReportImport())->import($request->file('template_file'));

        return back()->with('failed_imports', GbgImportState::getStatus());
    }

    public function match(Request $request)
    {
        $validatedData = $request->validate([
           'access_the_deal_id' => 'exists:access_the_deals,id',
           'gbg_report_id'      => 'exists:gbg_reports,id',
        ]);

        // Confirm "null" for access the deal id on the report
        /** @var GbgReport $gbgReport */
        $gbgReport = GbgReport::find($validatedData['gbg_report_id']);
        if ($gbgReport->access_the_deal_id) {
            abort(403,'You are trying to match a Gbg Report that is already matched');
        }

        /** @var AccessTheDeal $accessTheDeal */
        $accessTheDeal                   = AccessTheDeal::find($validatedData['access_the_deal_id']);
        if ($gbgReport->premium_amount > 0) {
            $accessTheDeal->loan_status_id   = DealStatus::SIGNED_THE_LOAN;
            $accessTheDeal->loan_amount      = $gbgReport->premium_amount;
            $accessTheDeal->disbursed_amount = $gbgReport->premium_amount;
            $accessTheDeal->applied_on       = $accessTheDeal->created_at;
            $accessTheDeal->signed_on        = now()->diffInDays($gbgReport->policy_start_date,false) < 0 ? $gbgReport->policy_start_date : now();
            $accessTheDeal->save();
        }

        $gbgReport->access_the_deal_id = $validatedData['access_the_deal_id'];
        $gbgReport->save();

        return back();
    }
}
