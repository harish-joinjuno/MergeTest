<?php


namespace App\Imports;

use App\MbaScholarship;
use App\TrackedLink;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MbaScholarships implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        try {
            $date = date_format(date_create($row['deadline']),'m-d');
            $date = '2021-' . $date;
        } catch (\Exception $e) {
            $date = null;
        }
        $eligibleProtectedClasses = [];
        if ($row['protected_class']) {
            $eligibleProtectedClasses = explode(', ', $row['protected_class']);
        }

        if ($row['military'] && $row['military'] === 'Yes') {
            $eligibleProtectedClasses[] = 'Military';
        }

        $citizenshipRequirement = $row['only_for_us_citizen_permanent_resident'] ? $row['only_for_us_citizen_permanent_resident'] === 'Yes' ? 1 : 0 : null;

        $data = [
            'name'                       => $row['scholarship_name_convert_to_title_case'],
            'application_due_by'         => $date,
            'max_amount'                 => $row['funds_max'],
            'description'                => $row['description'],
            'link'                       => $row['urlcontact_information'],
            'eligible_gender'            => $row['gender'],
            'eligible_protected_classes' => $eligibleProtectedClasses,
            'citizenship_requirement'    => $citizenshipRequirement,
            'eligible_states'            => null,
            'minimum_eligible_gpa'       => $row['gpa'],
        ];
        try {
            MbaScholarship::create($data);
        } catch (\Exception $e) {
//            dd($data);
        }
//
    }
}
