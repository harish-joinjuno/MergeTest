<?php


namespace App\Exports;

use App\CompletedCampusAmbassadorTask;
use App\LeveredgeRewardDistribution;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class CheckbookReport implements FromCollection,WithHeadings, Responsable
{
    use Exportable;

    private $fileName = 'checkbook_report.csv';

    private $writerType = Excel::CSV;

    public function headings(): array
    {
        return [
            'Check Send Date',
            'Check Number',
            'Amount',
            'Description',
        ];
    }

    public function collection()
    {
        $rewardDistributions = LeveredgeRewardDistribution::
        where('payment_completed',1)
            ->whereHas('rewardClaim',function($query) {
                $query->where('payment_method_id',1);
            })->get();

        $rows = [];
        foreach ($rewardDistributions as $rewardDistribution) {
            $amount       = $rewardDistribution->amount;
            $check_number = $rewardDistribution->payment->reference_information['number'];
            $payment_date = $rewardDistribution->payment->created_at;
            $description  = "Reward Distribution #" . $rewardDistribution->id;
            array_push($rows,[$payment_date, $check_number, $amount, $description]);
        }


        $completedTaskUsers = CompletedCampusAmbassadorTask::where('payment_completed',true)
        ->where('payment_method_id',1)
        ->whereNotNull('payment_record_id')
        ->get();

        foreach ($completedTaskUsers as $completedTaskUser) {
            $amount       = $completedTaskUser->amount;
            $check_number = $completedTaskUser->paymentRecord->reference_information['number'];
            $payment_date = $completedTaskUser->paymentRecord->created_at;
            $description  = "Completed Campus Ambassador Task #" . $completedTaskUser->id;
            array_push($rows,[$payment_date, $check_number, $amount, $description]);
        }

        return collect($rows);
    }
}
