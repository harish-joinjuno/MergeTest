<?php


namespace App\Exports;


use App\MarketingEmail;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

/**
 * @property string $fileName
 */
class MarketingEmailExport implements FromCollection,
                                      WithHeadings,
                                      Responsable,
                                      ShouldAutoSize,
                                      WithMapping
{
    use Exportable;

    private $writerType = Excel::CSV;

    public function __construct()
    {
        $this->fileName = 'marketing_emails_ ' . date('Y-m-d') . '.csv';
    }

    public function collection()
    {
        return MarketingEmail::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'marketing_email_template_id',
            'name',
            'email_address',
            'send_date',
            'status',
            'open',
            'click',
            'utm_source',
            'utm_campaign',
            'utm_medium',
            'utm_term',
            'utm_content',
            'fields'
        ];
    }

    public function map($marketingEmail): array
    {
        return [
            $marketingEmail->id,
            $marketingEmail->marketing_email_template_id,
            $marketingEmail->name,
            $marketingEmail->email_address,
            $marketingEmail->send_date->format('Y-m-d'),
            $marketingEmail->status,
            $marketingEmail->open,
            $marketingEmail->click,
            $marketingEmail->utm_source,
            $marketingEmail->utm_campaign,
            $marketingEmail->utm_medium,
            $marketingEmail->utm_term,
            $marketingEmail->utm_content,
            $marketingEmail->fields
        ];
    }
}
