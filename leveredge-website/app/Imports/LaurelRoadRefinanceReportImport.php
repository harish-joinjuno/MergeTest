<?php


namespace App\Imports;

use App\DealStatus;
use App\DealStatusApplicability;
use App\LaurelRoadRefinanceReport;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LaurelRoadRefinanceReportImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $fields = [
            'parnter_org_id',
            'partner_org_name',
            'application_date',
            'app_amount',
            'url_upcase',
            'los_stage',
            'cosigner_flag',
            'closing_date',
            'resident_flag',
            'rates_publish_date',
            'hard_pull_at',
            'loan_term',
            'loan_rate_type',
            'city',
            'state',
            'zip',
            'amount_waterfall',
            'degree',
            'med_specialty',
            'full_amount',
            'discount_partner',
            'discount_camaign_description',
            'school',
            'amount_to_refinance',
            'graduation_year',
        ];

        $refinanceReport = new LaurelRoadRefinanceReport;
        foreach ($fields as $field) {
            $refinanceReport->$field = isset($row[$field]) ? $row[$field] : null;
        }

        try {
            $refinanceReport->save();
        } catch (QueryException $exception) {
            // Skip this row. It's already saved in the database
            // The exception is thrown because we have a unique
            // constraint on the database.
        }
    }
}
