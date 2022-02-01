<?php


namespace App\Exports;


use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class MarketingEmailDeleteTemplateExport implements FromCollection,WithHeadings, Responsable
{

    use Exportable;

    private $fileName = 'delete_marketing_emails_template.csv';

    private $writerType = Excel::CSV;

    public function collection()
    {
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'id'
        ];
    }
}
