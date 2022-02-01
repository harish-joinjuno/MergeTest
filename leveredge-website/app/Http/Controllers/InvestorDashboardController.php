<?php

namespace App\Http\Controllers;

use App\Deal;
use App\DealStatus;
use App\DealType;
use App\TableauDashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestorDashboardController extends Controller
{
    public function index()
    {
        $dashboards = TableauDashboard::all();
        return view('investor-dashboard')->with('dashboards',$dashboards);
    }
}
