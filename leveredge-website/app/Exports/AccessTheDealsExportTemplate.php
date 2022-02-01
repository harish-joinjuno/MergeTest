<?php


namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class AccessTheDealsExportTemplate implements FromCollection,WithHeadings, Responsable
{
    use Exportable;

    private $fileName = 'update_access_the_deals.csv';

    private $writerType = Excel::CSV;

    public function headings(): array
    {
        return [
            'id',
            'loan_status',
            'loan_amount',
            'applied_on',
            'signed_on',
            'disbursed_amount',
            "you can add additional columns for variables you'd like to use in the email",
        ];
    }

    public function collection()
    {
        return collect([]);
    }
}
