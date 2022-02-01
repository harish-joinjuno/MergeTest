<?php


namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class FacebookAdMetricsExportTemplate implements FromCollection,WithHeadings, Responsable
{
    use Exportable;

    private $fileName = 'update_facebook_ad_metrics.csv';

    private $writerType = Excel::CSV;

    public function headings(): array
    {
        return [
            'Campaign Name',
            'Ad Set Name',
            'Ad Name',
            'Day',
            'Campaign ID',
            'Ad Set ID',
            'Ad ID',
            'Reach',
            'Impressions',
            'Frequency',
            'Amount Spent (USD)',
            'Unique Clicks'
        ];
    }

    public function collection()
    {
        return collect([]);
    }
}
