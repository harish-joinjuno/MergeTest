<?php


namespace App\Imports;

use App\TrackedLink;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class TrackedLinksImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $data = [
            'url'             => str_replace('app.', '', $row['url']),
            'utm_source'      => $row['source'],
            'utm_medium'      => $row['medium'],
            'utm_campaign'    => $row['campaign_name'],
            'utm_term'        => $row['term'],
            'utm_content'     => $row['content'],
            'hubspot_deal_id' => $row['deal_id_number'],
            'notes'           => $row['notes']
        ];

        TrackedLink::firstOrCreate($data, $data);
    }
}
