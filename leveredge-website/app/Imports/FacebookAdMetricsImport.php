<?php


namespace App\Imports;

use App\AccessTheDeal;
use App\DealStatus;
use App\DealStatusApplicability;
use App\Events\AccessTheDealStatusUpdated;
use App\FacebookAdMetric;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FacebookAdMetricsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $date = Carbon::createFromFormat('Y-m-d',$row['day']);

        $facebookAdMetric = FacebookAdMetric::where('campaign_id',$row['campaign_id'])
            ->where('ad_set_id',$row['ad_set_id'])
            ->where('ad_id',$row['ad_id'])
            ->whereDate('date', $date)
            ->first();

        if (!$facebookAdMetric) {
            $facebookAdMetric              = new FacebookAdMetric();
            $facebookAdMetric->campaign_id = $row['campaign_id'];
            $facebookAdMetric->ad_set_id   = $row['ad_set_id'];
            $facebookAdMetric->ad_id       = $row['ad_id'];
            $facebookAdMetric->date        = $date;
        }

        $facebookAdMetric->campaign_name = $row['campaign_name'];
        $facebookAdMetric->ad_set_name   = $row['ad_set_name'];
        $facebookAdMetric->ad_name       = $row['ad_name'];
        $facebookAdMetric->reach         = $row['reach'];
        $facebookAdMetric->impressions   = $row['impressions'];
        $facebookAdMetric->frequency     = $row['frequency'];
        $facebookAdMetric->cost          = $row['amount_spent_usd'];
        $facebookAdMetric->unique_clicks = $row['unique_clicks_all'];
        $facebookAdMetric->save();
    }
}
