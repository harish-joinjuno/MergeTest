<?php


namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class MarketingEmailTemplateExport implements FromCollection,WithHeadings, Responsable
{
    use Exportable;

    private $fileName = 'add_marketing_emails_template.csv';

    private $writerType = Excel::CSV;

    public function headings(): array
    {
        return [
            'marketing_email_template_id',
            'name',
            'email_address',
            'send_date',
            'utm_source',
            'utm_campaign',
            'utm_medium',
            'utm_term',
            'utm_content',
            "you can add additional columns for variables you'd like to use in the email",
        ];
    }

    public function collection()
    {
        return collect([]);
    }
}
