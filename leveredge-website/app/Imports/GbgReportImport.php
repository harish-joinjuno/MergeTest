<?php


namespace App\Imports;

use App\GbgReport;
use App\Imports\State\GbgImportState;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GbgReportImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $stringFields = [
            'type'                         => 'type',
            'policy_holdergroup_name'      => 'policy_holder',
            'status'                       => 'status',
            'product'                      => 'product',
            'agent_name'                   => 'agent_name',
            'premium_amount_currency'      => 'premium_amount_currency',
            'outstanding_balance_currency' => 'outstanding_balance_currency',
        ];

        $intFields = [
            'policy'                       => 'policy_number',
            'individualid'                 => 'individual_id',
        ];

        $dateFields = [
            'policy_start_date'            => 'policy_start_date',
            'policy_end_date'              => 'policy_end_date',
        ];

        $floatFields = [
            'premium_amount'               => 'premium_amount',
            'outstanding_balance'          => 'outstanding_balance',
        ];


        $gbgReport = new GbgReport();
        foreach ($stringFields as $index => $field) {
            $gbgReport->$field = $row[$index];
        }

        foreach ($intFields as $index => $field) {
            $gbgReport->$field = intval($row[$index]);
        }

        foreach ($dateFields as $index => $field) {
            $unixDate          = ($row[$index] - 25569) * 86400;
            $gbgReport->$field = Carbon::parse($unixDate);
        }

        foreach ($floatFields as $index => $field) {
            $gbgReport->$field = floatval( preg_replace('/[^\\d.]+/', '', $row[$index]));
        }

        try {
            $gbgReport->save();
        } catch (QueryException $exception) {
            $status                  = GbgImportState::getStatus();
            $status[$row['policy']]  = $exception->getMessage();
            GbgImportState::setStatus($status);
        }

    }
}
