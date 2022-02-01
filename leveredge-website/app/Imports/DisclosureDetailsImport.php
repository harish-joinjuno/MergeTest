<?php


namespace App\Imports;

use App\DisclosureDetail;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DisclosureDetailsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model($row)
    {
        /** @var DisclosureDetail $disclosureDetail */
        $disclosureDetail  = DisclosureDetail::whereLeveredgeRewardClaimId($row['leveredge_reward_claim_id'])->first();
        $rightToCancelDate = null;
        if ($row['right_to_cancel_date']) {
            $rightToCancelDate = Carbon::createFromFormat('m/d/Y', $row['right_to_cancel_date'])->format('Y-m-d');
        }
        if ($disclosureDetail) {
            $disclosureDetail->repayment_plan       = $row['repayment_plan'] ?: null;
            $disclosureDetail->borrower_name        = $row['borrower_name'] ?: null;
            $disclosureDetail->cosigner_name        = $row['cosigner_name'] ?: null;
            $disclosureDetail->creditor             = $row['creditor'] ?: null;
            $disclosureDetail->right_to_cancel      = $row['right_to_cancel'] ?: null;
            $disclosureDetail->right_to_cancel_date = $rightToCancelDate;
            $disclosureDetail->total_loan_amount    = str_replace(',', '',$row['total_loan_amount']) ?: null;
            $disclosureDetail->interest_rate        = $row['interest_rate'] ?: null;
            $disclosureDetail->finance_charge       = str_replace(',', '',$row['finance_charge']) ?: null;
            $disclosureDetail->total_payments       = str_replace(',', '',$row['total_payments']) ?: null;
            $disclosureDetail->rate_type            = $row['rate_type'] ?: null;
            $disclosureDetail->apr                  = $row['apr'] ?: null;
            $disclosureDetail->loan_term            = $row['loan_term'] ?: null;
            $disclosureDetail->save();
        }
    }
}
