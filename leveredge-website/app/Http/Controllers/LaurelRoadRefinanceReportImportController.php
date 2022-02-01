<?php

namespace App\Http\Controllers;

use App\AccessTheDeal;
use App\DealStatus;
use App\Imports\LaurelRoadRefinanceReportImport;
use App\LaurelRoadRefinanceReport;
use Illuminate\Http\Request;

class LaurelRoadRefinanceReportImportController extends Controller
{
    public function show()
    {
        return view('admin.imports.laurel-road-refinance-report');
    }

    public function import(Request $request)
    {
        (new LaurelRoadRefinanceReportImport())->import($request->file('template_file'));

        return redirect('/admin/imports/laurel-road-refinance-report')->with('success','Report Saved');
    }

    public function showMatches(Request $request)
    {
        $limit             = $request->has('limit') ? $request->get('limit') : 100;
        $amountSensitivity = $request->has('amount_sensitivity') ? $request->get('amount_sensitivity') : 1000;
        $daysSensitivity   = $request->has('days_sensitivity') ? $request->get('days_sensitivity') : 1;
        $hideRedLine       = $request->has('hide_red_line') ? $request->get('hide_red_line') : 1;
        $showOnlySigned    = $request->has('show_only_signed') ? $request->get('show_only_signed') : 1;

        $query = LaurelRoadRefinanceReport::whereNull('access_the_deal_id')
            ->limit($limit);

        if ($showOnlySigned) {
            $query->where('los_stage','closed_funded');
        }
        $reportsWithoutMatches = $query->get();

        return view('admin.imports.laurel-road-refinance-report-matches')
            ->with(compact([
                'reportsWithoutMatches',
                'limit',
                'amountSensitivity',
                'daysSensitivity',
                'hideRedLine',
                'showOnlySigned',
            ]));
    }

    public function saveMatch(Request $request)
    {
        $rules = [
            'access_the_deal_id'              => 'required|exists:access_the_deals,id',
            'laurel_road_refinance_report_id' => 'required|exists:laurel_road_refinance_reports,id',
        ];

        $validatedData = $request->validate($rules);

        $statusMap = [
            'initial'          => DealStatus::STARTED_APPLICATION,
            'processing'       => DealStatus::STARTED_APPLICATION,
            'applied'          => DealStatus::RECEIVED_PRELIMINARY_QUOTES_ID,
            'waiting_for_docs' => DealStatus::RECEIVED_PRELIMINARY_QUOTES_ID,
            'approved'         => DealStatus::APPROVED_BY_LENDER,
            'pending_closing'  => DealStatus::APPROVED_BY_LENDER,
            'closed_funded'    => DealStatus::SIGNED_THE_LOAN,
            'approved_expired' => DealStatus::WITHDRAWN_BY_LENDER,
            'withdrawn'        => DealStatus::WITHDRAWN_BY_LENDER,
            'denied'           => DealStatus::REJECTED_BY_LENDER,
        ];

        /** @var AccessTheDeal $accessTheDeal */
        $accessTheDeal = AccessTheDeal::find($validatedData['access_the_deal_id']);

        /** @var LaurelRoadRefinanceReport $report */
        $report        = LaurelRoadRefinanceReport::find($validatedData['laurel_road_refinance_report_id']);

        // Connect the report to the access the deal id
        $report->access_the_deal_id = $accessTheDeal->id;
        $report->save();

        // Update Status of Deal
        $properties                                    = $accessTheDeal->properties;
        $properties['laurel_road_refinance_report_id'] = $report->id;
        $accessTheDeal->properties                     = $properties;

        $accessTheDeal->loan_status_id = $statusMap[$report->los_stage];

        if ($report->full_amount) {
            $accessTheDeal->loan_amount = $report->full_amount;
        } else {
            $accessTheDeal->loan_amount = $report->amount_waterfall;
        }

        $accessTheDeal->applied_on = $report->hard_pull_at;
        $accessTheDeal->signed_on  = $report->closing_date;

        if ($accessTheDeal->loan_status_id == DealStatus::SIGNED_THE_LOAN) {
            $accessTheDeal->disbursed_amount = $accessTheDeal->loan_amount;
        }

        $accessTheDeal->save();

        return response()->json([],200);
    }
}
