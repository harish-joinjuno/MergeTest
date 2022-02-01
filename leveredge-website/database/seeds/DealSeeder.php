<?php

use App\Deal;
use App\FeeType;
use App\DealType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DealSeeder extends Seeder
{
    public function run()
    {
        $defaultDeals = [
            0 => [
                'name' => 'Laurel Road 2019-2020 Student Loan Deal',
                'description' => 'This deal is for graduate students at select programs',
                'start_date' => '2019-06-25',
                'end_date' => '2020-05-01',
                'redirect_url' => 'https://www.laurelroad.com/graduate-school-loans-leveredge/?partner_name=leveredge',
                'tracked_query_parameter' => 'subId',
                'allow_guest_access' => true,
                'deal_type_id' => DealType::GRADUATE_STUDENT_LOAN,
                'fee_type_id' => FeeType::PERCENTAGE_OF_LOANS_ORIGINATED,
                'percentage_of_loan_amount' => '1%',
                'slug' => 'laurel-road'
            ],

            1 => [
                'name' => 'Earnest 2019 Refinance Deal',
                'description' => 'This deal is for refinance for all LeverEdge Members',
                'start_date' => '2019-06-20',
                'end_date' => '2019-08-31',
                'redirect_url' => 'https://partner.earnest.com/referral/09d5933b-ed87-41db-9c04-2ce5a58db284?utm_source=lever_edge&utm_medium=referral',
                'tracked_query_parameter' => 'utm_content',
                'allow_guest_access' => true,
                'deal_type_id' => DealType::REFINANCE_STUDENT_LOAN,
                'fee_type_id' => FeeType::PERCENTAGE_OF_LOANS_ORIGINATED,
                'percentage_of_loan_amount' => '0.25%',
                'slug' => 'earnest-2019-refi'
            ],

            2 => [
                'name' => 'Credible Student Loans Deal',
                'description' => 'This deal is a back up deal for any users that are rejected from other deals.',
                'start_date' => '2019-06-06',
                'end_date' => null,
                'redirect_url' => 'https://www.credible.com/student-loans/?utm_source=leveredge&utm_medium=referral&utm_campaign=student_loans',
                'tracked_query_parameter' => 'utm_content',
                'allow_guest_access' => true,
                'deal_type_id' => DealType::GRAD_AND_UNDERGRAD_STUDENT_LOAN,
                'fee_type_id' => FeeType::PERCENTAGE_OF_LOANS_ORIGINATED,
                'percentage_of_loan_amount' => '0.50%',
                'slug' => 'credible-student-loan'
            ],

            3 => [
                'name' => 'Credible Refinance Deal',
                'description' => 'This deal is a backup deal for any users that are rejected from other deals.',
                'start_date' => '2019-06-06',
                'end_date' => null,
                'redirect_url' => 'https://www.credible.com/refinance-student-loans/?utm_source=leveredge&utm_medium=referral&utm_campaign=student_loan_refi',
                'tracked_query_parameter' => 'utm_content',
                'allow_guest_access' => true,
                'deal_type_id' => DealType::REFINANCE_STUDENT_LOAN,
                'fee_type_id' => FeeType::PERCENTAGE_OF_LOANS_ORIGINATED,
                'percentage_of_loan_amount' => '0.25%',
                'slug' => 'credible-refi'
            ],

            4 => [
                'name' => 'Earnest Longterm Refinance Deal',
                'description' => 'This deal is a long term deal with Earnest for Refinance loans',
                'start_date' => '2020-01-15',
                'end_date' => null,
                'redirect_url' => 'https://partner.earnest.com/referral/fa84aa0e-7237-4eab-a22e-a29fe4bb123c?utm_source=lever_edge&utm_medium=referral',
                'tracked_query_parameter' => 'utm_content',
                'allow_guest_access' => true,
                'deal_type_id' => DealType::REFINANCE_STUDENT_LOAN,
                'fee_type_id' => FeeType::PERCENTAGE_OF_LOANS_ORIGINATED,
                'percentage_of_loan_amount' => '0%',
                'slug' => 'earnest-refinance-2020'
            ]
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Deal::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach($defaultDeals as $deal) {
            Deal::create($deal);
        }
    }
}
