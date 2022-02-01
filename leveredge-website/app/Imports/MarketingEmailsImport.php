<?php


namespace App\Imports;

use App\Imports\State\MarketingEmailsImportState;
use App\MarketingEmail;
use App\MarketingEmailTemplate;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Excel;

class MarketingEmailsImport implements ToModel, WithHeadingRow
{
    use Importable;

    private $writerType = Excel::CSV;

    public function model(array $row)
    {
        $validations = MarketingEmailsImportState::getValidations();

        $currentValidation = [];

        if (empty($row['marketing_email_template_id']) || ! MarketingEmailTemplate::where('id', $row['marketing_email_template_id'])->exists()) {
            $currentValidation = [
                'type'    => 'danger',
                'message' => 'Error, Marketing Email Template ID is not valid',
            ];
        } else {
            if (empty($row['email_address']) || !preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$^",$row['email_address'])) {
                $currentValidation = [
                'type'    => 'danger',
                'message' => 'Error, Email Address is not valid',
            ];
            } else {
                if (empty($row['send_date']) || $row['send_date'] < date('Y-m-d')) {
                    $currentValidation = [
                'type'    => 'danger',
                'message' => 'Error, Send Date is not valid (empty or in past date)',
            ];
                }
            }
        }

        $fields                              = array_slice($row, array_search('utm_content', array_keys($row)) + 1);
        $data['marketing_email_template_id'] = $row['marketing_email_template_id'];
        $data['name']                        = $row['name'];
        $data['email_address']               = $row['email_address'];
        $data['send_date']                   = $row['send_date'];
        $data['utm_source']                  = $row['utm_source'];
        $data['utm_campaign']                = $row['utm_campaign'];
        $data['utm_medium']                  = $row['utm_medium'];
        $data['utm_term']                    = $row['utm_term'];
        $data['utm_content']                 = $row['utm_content'];
        $data['fields']                      = $fields;
        if (count($currentValidation) === 0) {
            $marketingEmail = MarketingEmail::firstOrCreate([
                'marketing_email_template_id' => $row['marketing_email_template_id'],
                'name'                        => $row['name'],
                'email_address'               => $row['email_address'],
                'send_date'                   => $row['send_date'],
            ], $data);

            $warningMessage = '';

            if (empty($row['name'])) {
                $warningMessage = ' (WARNING!) Name is stored as empty';
            }

            if ($marketingEmail->wasRecentlyCreated) {
                $currentValidation = [
                    'type'    => 'success',
                    'message' => 'Successfully created' . $warningMessage,
                ];
            } else {
                $currentValidation = [
                    'type'    => 'success',
                    'message' => 'Was already in the database' . $warningMessage,
                ];
            }
        }

        $validations[] = $currentValidation;

        MarketingEmailsImportState::setValidations($validations);
    }
}
