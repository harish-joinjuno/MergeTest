<?php

namespace App\Http\Controllers;

use App\AccessTheDeal;
use Illuminate\Http\Request;

class MissingAccessTheDealsDatesController extends Controller
{
    public function index()
    {
        $summary = AccessTheDeal::selectRaw('d.name, count(access_the_deals.id) as total')
            ->groupBy('deal_id')
            ->leftjoin('deals as d', function($join) {
                $join->on('d.id','=','access_the_deals.deal_id');
            })
            ->where('loan_status_id','<>',1)
            ->whereNull('applied_on')
            ->where('deal_id','<>',1)
            ->get();

        $summary_signed_on = AccessTheDeal::selectRaw('d.name, count(access_the_deals.id) as total')
            ->groupBy('deal_id')
            ->leftjoin('deals as d', function($join) {
                $join->on('d.id','=','access_the_deals.deal_id');
            })
            ->where('loan_status_id',8)
            ->whereNull('signed_on')
            ->where('deal_id','<>',1)
            ->get();

        $accessTheDeals = AccessTheDeal::where('loan_status_id','<>',1)->whereNull('applied_on')->where('deal_id','<>',1)->get();

        return view('admin.missing-access-the-deals-dates')->with(compact(['accessTheDeals','summary','summary_signed_on']));
    }
}
