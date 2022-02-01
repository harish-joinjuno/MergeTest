<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartnerHomeController extends Controller
{
    public function index()
    {
        $partner = user();
        return view('partner.home')->with(compact('partner'));
    }
}
