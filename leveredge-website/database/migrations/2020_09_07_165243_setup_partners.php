<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetupPartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $metric_definitions = [
            'App\Partnerships\Concretes\MetricsDefinition\ReferredUsers',
            'App\Partnerships\Concretes\MetricsDefinition\ClickedToLender',
            'App\Partnerships\Concretes\MetricsDefinition\ClosedWithLender',

            'App\Partnerships\Concretes\MetricsDefinition\ClickedToInsurance',
            'App\Partnerships\Concretes\MetricsDefinition\ClosedWithInsurance',

            'App\Partnerships\Concretes\MetricsDefinition\ReferredUsersByCampusAmbassador',
            'App\Partnerships\Concretes\MetricsDefinition\UsersReferredByCampusAmbassadorsClickedToLender',
            'App\Partnerships\Concretes\MetricsDefinition\UsersReferredByCampusAmbassadorsClosedWithLender',
            'App\Partnerships\Concretes\MetricsDefinition\ClosedLoanAmountByUsersReferredByCampusAmbassadors',

            'App\Partnerships\Concretes\MetricsDefinition\ReferredUsersByUtmSourceBold',
            'App\Partnerships\Concretes\MetricsDefinition\UtmSourceBoldUsersClickedToLender',
            'App\Partnerships\Concretes\MetricsDefinition\UtmSourceBoldUsersClosedWithLender',
            'App\Partnerships\Concretes\MetricsDefinition\LoanAmountClosedByUtmSourceBoldUsers',
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($metric_definitions as $metric_definition) {
            $metric                    = new \App\Metric();
            $metric->metric_definition = $metric_definition;
            $metric->save();

            if (!env('APP_ENV') == 'production') {
                $contractTypeMetric                   = new \App\ContractTypeMetric();
                $contractTypeMetric->contract_type_id = 7;
                $contractTypeMetric->metric_id        = $metric->id;
                $contractTypeMetric->save();
            }
        }

        // Add Deals
        $deals = [
            [
                'id'                        => 1,
                'percentage_of_loan_amount' => 1,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\LaurelRoad20192020StudentLoanDeal',
            ],
            [
                'id'                        => 2,
                'percentage_of_loan_amount' => 0.25,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\Earnest2019RefinanceDeal',
            ],
            [
                'id'                        => 3,
                'percentage_of_loan_amount' => 2.50,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\CredibleStudentLoansDeal',
            ],
            [
                'id'                        => 4,
                'percentage_of_loan_amount' => 0.50,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\CredibleRefinanceDeal',
            ],
            [
                'id'                        => 5,
                'percentage_of_loan_amount' => 0.85,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\EarnestLongTermRefinanceDeal',
            ],
            [
                'id'                        => 6,
                'percentage_of_loan_amount' => 0.55,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\CommonBondMBA2021',
            ],
            [
                'id'                        => 7,
                'percentage_of_loan_amount' => 1.50,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\EarnestGraduateLoan',
            ],
            [
                'id'                        => 8,
                'percentage_of_loan_amount' => 1.50,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\EarnestUndergraduateLoan',
            ],
            [
                'id'                        => 9,
                'percentage_of_loan_amount' => 0.85,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\EarnestRefinanceDealWithRewards',
            ],
            [
                'id'                        => 10,
                'percentage_of_loan_amount' => 0.85,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\EarnestRefinanceDealWithRewardsInOtherStates',
            ],
            [
                'id'                         => 11,
                'percentage_of_loan_amount'  => 20,
                'fee_amount'                 => 0,
                'revenue_calculator'         => 'App\Partnerships\Concretes\RevenueCalculator\GBGStudentHealthInsurance',
            ],
            [
                'id'                        => 12,
                'percentage_of_loan_amount' => 0,
                'fee_amount'                => 1000,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\FirstRepublicPersonalLineOfCredit',
            ],
            [
                'id'                        => 13,
                'percentage_of_loan_amount' => 0.85,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\SplashRefinanceDeal',
            ],
            [
                'id'                        => 14,
                'percentage_of_loan_amount' => 0.85,
                'fee_amount'                => 0,
                'revenue_calculator'        => 'App\Partnerships\Concretes\RevenueCalculator\LaurelRoadRefinanceDeal',
            ],
        ];

        foreach ($deals as $deal) {
            /** @var \App\Deal $dealRecord */
            $dealRecord                            = \App\Deal::find($deal['id']);
            if ($dealRecord) {
                $dealRecord->percentage_of_loan_amount = $deal['percentage_of_loan_amount'];
                $dealRecord->fee_amount                = $deal['fee_amount'];
                $dealRecord->revenue_calculator        = $deal['revenue_calculator'];
                $dealRecord->save();
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
//        $contractTypeMetrics = [
//            ['user_id' => 26321, 'metric_ids' => [10,11,12,13]], // BOLD
//            ['user_id' => 17590, 'metric_ids' => [6,7,8,9]], // Shehzan
//        ];
//
//        foreach ($contractTypeMetrics as $metricData) {
//            /** @var User $user */
//            $user = User::find($metricData['user_id']);
//            foreach ($metricData['metric_ids'] as $metric_id) {
//                $contractTypeMetric                   = new \App\ContractTypeMetric();
//                $contractTypeMetric->contract_type_id = $user->partnerProfile->contractType->id;
//                $contractTypeMetric->metric_id        = $metric_id;
//                $contractTypeMetric->save();
//            }
//        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \Illuminate\Support\Facades\DB::table('contract_type_metrics')->truncate();
        \Illuminate\Support\Facades\DB::table('metrics')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
