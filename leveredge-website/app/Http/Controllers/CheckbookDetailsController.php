<?php

namespace App\Http\Controllers;

use App\Exports\CheckbookReport;
use Illuminate\Http\Request;

class CheckbookDetailsController extends Controller
{
    public function getCheckbook()
    {
        return view('admin.exports.checkbook');
    }

    public function getCheckbookReport()
    {
        return new CheckbookReport();
    }
}
