<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Imports\DisclosureDetailsImport;
use Illuminate\Http\Request;

class DisclosureDetailsController extends Controller
{
    public function show()
    {
        return view('admin.imports.disclosure-details-repayment-plans');
    }

    public function import(Request $request)
    {
        (new DisclosureDetailsImport())->import($request->file('repayment_plans'));

        return redirect('/admin/imports/disclosure-details-repayment-plans')->with('success','Report Uploaded');
    }
}
