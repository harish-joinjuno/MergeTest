<?php


namespace App\Imports;

use App\AccessTheDeal;
use App\DealStatus;
use App\DealStatusApplicability;
use App\Events\AccessTheDealStatusUpdated;
use App\Events\UpdateSociallyPowered;
use App\Imports\State\AccessTheDealsImportState;
use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AccessTheDealsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $accessTheDealStatuses = AccessTheDealsImportState::getStatus();
        /** @var AccessTheDeal $accessTheDeal */
        if ($accessTheDeal = AccessTheDeal::find($row['id'])) {
            $dealStatus = DealStatus::whereLoanStatus($row['loan_status'])->first();
            if ($dealStatus) {
                if (DealStatusApplicability::whereDealId($accessTheDeal->deal_id)->whereDealStatusId($dealStatus->id)->exists()) {
//                    $properties                      = array_slice($row, array_search('loan_amount', array_keys($row)) + 1);
                    $properties                      = $row;

                    if ($accessTheDeal->disbursed_amount) {
                        if ($row['disbursed_amount'] > $accessTheDeal->disbursed_amount ) {
                            if ($row['disbursed_amount'] > 0) {
                                $accessTheDeal->disbursed_amount = $row['disbursed_amount'];
                            }
                        }
                    } else {
                        if ($row['disbursed_amount'] > 0) {
                            $accessTheDeal->disbursed_amount = $row['disbursed_amount'];
                        }
                    }

                    if (!$accessTheDeal->applied_on) {
                        $accessTheDeal->applied_on       = $row['applied_on'];
                    }
                    if (!$accessTheDeal->signed_on) {
                        $accessTheDeal->signed_on        = $row['signed_on'];
                    }
                    $accessTheDeal->loan_status      = $dealStatus->loan_status;

                    if ($accessTheDeal->loan_amount) {
                        if ($row['loan_amount'] > $accessTheDeal->loan_amount) {
                            if ($row['loan_amount'] > 0) {
                                $accessTheDeal->loan_amount      = $row['loan_amount'];
                            }
                        }
                    } else {
                        if ($row['loan_amount'] > 0) {
                            $accessTheDeal->loan_amount      = $row['loan_amount'];
                        }
                    }

                    $accessTheDeal->loan_status_id   = $dealStatus->id;
                    $accessTheDeal->properties       = $properties;
                    $accessTheDeal->save();

                    $changedColumns = $accessTheDeal->getChanges();

                    if (count($changedColumns) && isset($changedColumns['loan_status'])) {
                        event(new AccessTheDealStatusUpdated($accessTheDeal->user, $accessTheDeal));

                        if ($accessTheDeal->user->email === User::SOCIALLY_POWERED_EMAIL) {
                            event(new UpdateSociallyPowered($accessTheDeal->user, $accessTheDeal));
                        }

                        $accessTheDealStatuses[] = [
                            'id'          => $accessTheDeal->id,
                            'user_name'   => $accessTheDeal->user->name,
                            'user_email'  => $accessTheDeal->user->email,
                            'loan_amount' => $accessTheDeal->loan_amount,
                            'status'      => $accessTheDeal->dealStatus->loan_status,
                            'type'        => 'success',
                            'message'     => 'Updated Successfully',
                        ];
                    } else {
                        $accessTheDealStatuses[] = [
                            'id'          => $accessTheDeal->id,
                            'user_name'   => $accessTheDeal->user->name,
                            'user_email'  => $accessTheDeal->user->email,
                            'loan_amount' => $accessTheDeal->loan_amount,
                            'status'      => $row['loan_status'],
                            'type'        => 'info',
                            'message'     => count($changedColumns) ? 'Loan Status is not changed' : 'Nothing Updated',
                        ];
                    }
                } else {
                    $accessTheDealStatuses[] = [
                        'type'    => 'danger',
                        'message' => 'Deal Id (' . $row['id'] . ') is not matching with the Deal Status ID - (' . $dealStatus->id . ')',
                    ];
                }
            } else {
                $accessTheDealStatuses[] = [
                    'id'          => $accessTheDeal->id,
                    'user_name'   => $accessTheDeal->user->name,
                    'user_email'  => $accessTheDeal->user->email,
                    'loan_amount' => $accessTheDeal->loan_amount,
                    'status'      => $row['loan_status'],
                    'type'        => 'info',
                    'message'     => 'Loan status is not valid',
                ];
            }
        } else {
            $accessTheDealStatuses[] = [
                'type'    => 'danger',
                'message' => 'Wrong Access the Deal Id - ' . $row['id'],
            ];
        }

        AccessTheDealsImportState::setStatus($accessTheDealStatuses);
    }
}
