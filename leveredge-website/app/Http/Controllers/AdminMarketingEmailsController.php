<?php


namespace App\Http\Controllers;

use App\Exports\MarketingEmailDeleteTemplateExport;
use App\Exports\MarketingEmailExport;
use App\Exports\MarketingEmailTemplateExport;
use App\Imports\MarketingEmailsDeleteImport;
use App\Imports\MarketingEmailsImport;
use App\Imports\State\MarketingEmailsDeleteImportState;
use App\Imports\State\MarketingEmailsImportState;
use App\Jobs\MarketingEmailCsvJob;
use Illuminate\Http\Request;

class AdminMarketingEmailsController extends Controller
{
    public function index()
    {
        return view('admin.marketing-emails.index');
    }

    public function download()
    {
        $filePath = 'marketing_emails_ ' . date('Y-m-d') . '.csv';

        dispatch_now(new MarketingEmailCsvJob($filePath));

        return response()
            ->download(storage_path('app/marketing-emails/' . $filePath),
                'marketing_emails_ ' . date('Y-m-d') . '.csv', [
                    'Content-type'        => 'text/csv',
                    'Content-Disposition' => 'attachment; ' . $filePath,
                ])->deleteFileAfterSend();
    }

    public function addNewRows()
    {
        return view('admin.marketing-emails.add-new-rows');
    }

    public function downloadTemplate()
    {
        return new MarketingEmailTemplateExport();
    }

    public function uploadTemplate(Request $request)
    {
        (new MarketingEmailsImport())->import($request->file('template_file'));

        return back()->with(['importValidations' => MarketingEmailsImportState::getValidations()]);
    }

    public function deleteRows()
    {
        return view('admin.marketing-emails.delete-rows');
    }

    public function downloadDeleteRows()
    {
        return new MarketingEmailDeleteTemplateExport();
    }

    public function uploadDeleteTemplate(Request $request)
    {
        (new MarketingEmailsDeleteImport())->import($request->file('template_file'));

        return back()->with(['deleteValidations' => MarketingEmailsDeleteImportState::getValidations()]);
    }
}
