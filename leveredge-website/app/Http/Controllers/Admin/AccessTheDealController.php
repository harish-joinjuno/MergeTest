<?php


namespace App\Http\Controllers\Admin;

use App\Exports\AccessTheDealsExportTemplate;
use App\Http\Controllers\Controller;
use App\Imports\AccessTheDealsImport;
use App\Imports\State\AccessTheDealsImportState;
use Illuminate\Http\Request;

class AccessTheDealController extends Controller
{
    public function index()
    {
        return view('admin.imports.access-the-deals');
    }

    public function template()
    {
        return new AccessTheDealsExportTemplate();
    }

    public function import(Request $request)
    {
        (new AccessTheDealsImport())->import($request->file('template_file'));

        return back()->with('successfulImports', AccessTheDealsImportState::getStatus());
    }
}
