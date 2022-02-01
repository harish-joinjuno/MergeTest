<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpiredDealController extends Controller
{
    public function index()
    {
        return redirectWithQueryParams('/');
    }
}
