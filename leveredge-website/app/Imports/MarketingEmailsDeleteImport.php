<?php


namespace App\Imports;

use App\Imports\State\MarketingEmailsDeleteImportState;
use App\MarketingEmail;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MarketingEmailsDeleteImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $validations = MarketingEmailsDeleteImportState::getValidations();

        $currentValidation = [];

        if (empty($row['id']) || ! MarketingEmail::where('id', $row['id'])->exists()) {
            $currentValidation = [
                'type'    => 'danger',
                'message' => 'Error, Marketing Email ID is not valid',
            ];
        }

        if (count($currentValidation) === 0) {
            MarketingEmail::destroy($row['id']);

            $currentValidation = [
                'type'    => 'success',
                'message' => 'Marketing Email record is deleted successfully',
            ];
        }

        $validations[] = $currentValidation;

        MarketingEmailsDeleteImportState::setValidations($validations);
    }
}
