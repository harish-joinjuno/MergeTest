<?php

namespace App\Http\Controllers;

use App\Imports\TrackedLinksImport;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function getImports()
    {
        return view('admin.imports.index');
    }

    public function importTrackedLinks()
    {
        (new TrackedLinksImport())->import(database_path('/seeds/tracked_links.csv'));

        return back();
    }
}
