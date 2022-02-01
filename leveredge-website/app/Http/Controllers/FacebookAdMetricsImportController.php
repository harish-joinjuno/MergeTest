<?php

namespace App\Http\Controllers;

use App\Exports\FacebookAdMetricsExportTemplate;
use App\Imports\FacebookAdMetricsImport;
use Illuminate\Http\Request;

class FacebookAdMetricsImportController extends Controller
{
    public function getFacebookAdMetrics(Request $request)
    {
        return view('admin.imports.facebook-ad-metrics');
    }

    public function getFacebookAdMetricsTemplate()
    {
        return new FacebookAdMetricsExportTemplate();
    }

    public function importFacebookAdMetrics(Request $request)
    {
        (new FacebookAdMetricsImport())->import($request->file('template_file'));
        return back();
    }
}
