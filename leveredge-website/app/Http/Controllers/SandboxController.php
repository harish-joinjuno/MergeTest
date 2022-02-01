<?php

namespace App\Http\Controllers;

use App\CompletedCampusAmbassadorTask;
use App\InschoolSubscriber;
use App\LeveredgeRewardClaim;
use App\LeveredgeRewardDistribution;
use App\Setting;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class SandboxController extends Controller
{
    public function __invoke()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=checkbook' . date('FdY') . '.csv',
            'Expires'             => '0',
            'Pragma'              => 'no-cache',
        ];

        $columns = [
            'Check Number',
            'Account',
        ];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach (LeveredgeRewardDistribution::all() as $rewardDistribution) {
                if ($rewardDistribution->payment_method_id == 1) {
                    fputcsv($file, [
                        $rewardDistribution->payment->reference_information['number'],
                        '6830 Customer Rewards',
                    ]);
                }
            }

            foreach (CompletedCampusAmbassadorTask::all() as $completedCampusAmbassadorTask) {
                fputcsv($file, [
                    $completedCampusAmbassadorTask->paymentRecord->reference_information['number'],
                    '6810 Campus Ambassador',
                ]);
            }

            // Close the file
            fclose($file);
        };

        // Return the response
        return Response::stream($callback, 200, $headers);
    }
}
