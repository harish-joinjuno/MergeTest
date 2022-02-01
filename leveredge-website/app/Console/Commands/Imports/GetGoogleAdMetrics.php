<?php

namespace App\Console\Commands\Imports;

use App\GoogleAdMetric;
use Carbon\Carbon;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\Lib\V5\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\V5\Services\GoogleAdsRow;
use Google\ApiCore\ApiException;
use Google\ApiCore\ValidationException;
use Illuminate\Console\Command;

class GetGoogleAdMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-metrics:google-ads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws ApiException
     * @throws ValidationException
     */
    public function handle()
    {
        $oAuth2Credential = (new OAuth2TokenBuilder())
            ->withClientId(env('GOOGLE_ADS_DESKTOP_CLIENT_ID'))
            ->withClientSecret(env('GOOGLE_ADS_DESKTOP_CLIENT_SECRET'))
            ->withRefreshToken(env('GOOGLE_ADS_DESKTOP_CLIENT_REFRESH_TOKEN'))
            ->build();

        $googleAdsClient = (new GoogleAdsClientBuilder())
            ->withOAuth2Credential($oAuth2Credential)
            ->withDeveloperToken(env('GOOGLE_ADS_DEVELOPER_TOKEN'))
            ->withLoginCustomerId(env('GOOGLE_ADS_CUSTOMER_ID'))
            ->build();


        $customerId = env('GOOGLE_ADS_CUSTOMER_ID');

        $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();

        $query =
            "SELECT campaign.id, "
            . "campaign.name, "
            . "ad_group.id, "
            . "ad_group.name, "
            . "ad_group_criterion.criterion_id, "
            . "ad_group_criterion.keyword.text, "
            . "ad_group_criterion.keyword.match_type, "
            . "segments.date, "
            . "metrics.impressions, "
            . "metrics.clicks, "
            . "metrics.cost_micros "
            . "FROM keyword_view "
            . "WHERE segments.date DURING LAST_30_DAYS "
            . "AND campaign.advertising_channel_type = 'SEARCH' "
            . "AND ad_group.status = 'ENABLED' "
            . "AND ad_group_criterion.status IN ('ENABLED', 'PAUSED') "
            . "ORDER BY metrics.impressions DESC "
            . "LIMIT 1000";

        // Issues a search stream request
        $response = $googleAdsServiceClient->search($customerId, $query);

        // Iterates over all rows in all messages and prints the requested field values for
        // the campaign in each row.
        foreach ($response->iterateAllElements() as $googleAdsRow) {
            /** @var GoogleAdsRow $googleAdsRow */

            GoogleAdMetric::updateOrCreate(
                [
                    'date'                                  => $googleAdsRow->getSegments()->getDate(),
                    'campaign_id'                           => (string)$googleAdsRow->getCampaign()->getId(),
                    'ad_group_id'                           => (string)$googleAdsRow->getAdGroup()->getId(),
                    'ad_group_criterion_id'                 => (string)$googleAdsRow->getAdGroupCriterion()->getCriterionId(),
                    'ad_group_criterion_keyword_text'       => $googleAdsRow->getAdGroupCriterion()->getKeyword()->getText(),
                    'ad_group_criterion_keyword_match_type' => $googleAdsRow->getAdGroupCriterion()->getKeyword()->getMatchType(),
                ],
                [
                    'campaign_name'                         => $googleAdsRow->getCampaign()->getName(),
                    'ad_group_name'                         => $googleAdsRow->getAdGroup()->getName(),
                    'impressions'                           => $googleAdsRow->getMetrics()->getImpressions(),
                    'clicks'                                => $googleAdsRow->getMetrics()->getClicks(),
                    'cost'                                  => $googleAdsRow->getMetrics()->getCostMicros()/1000000,
                ]
            );
        }
    }
}
