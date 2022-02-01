<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropertiesToLeveredgeRewardClaims extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leveredge_reward_claims', function (Blueprint $table) {
            $table->json('properties')->after('access_the_deal_id')->nullable();
        });

        if (! app()->runningUnitTests() && app()->environment('production')) {
            $dataToUpdate = [
                4   => ['Final Disclosure', '9/25/2020'],
                8   => ['Approval Disclosure', '10/19/2020'],
                10  => ['Final Disclosure', '9/10/2020'],
                20  => ['Final Disclosure', '8/7/2020'],
                26  => ['Final Disclosure', '7/16/2020'],
                34  => ['Approval Disclosure', '8/31/2020'],
                45  => ['Final Disclosure', '9/24/2020'],
                46  => ['Final Disclosure', '08/11/2020'],
                49  => ['Final Disclosure', '8/24/2020'],
                62  => ['Application Self-Certification'],
                67  => ['Approval Disclosure', '08/17/2020'],
                72  => ['Approval Disclosure', '10/19/2020'],
                86  => ['Final Disclosure', '1/28/2021'],
                107 => ['Final Disclosure', '8/11/2020'],
                109 => ['Approval Disclosure', '10/19/2020'],
                112 => ['Approval Disclosure', '10/19/2020'],
                113 => ['Final Disclosure', '8/24/2020'],
                114 => ['Final Disclosure', '7/28/2020'],
                145 => ['Solicitation Disclosure'],
                174 => ['Final Disclosure', '7/27/2020'],
                188 => ['Application Self-Certification'],
                194 => ['Final Disclosure', '09/17/2020'],
                195 => ['Approval Disclosure', '07/17/2020'],
                199 => ['Approval Disclosure', '08/17/2020'],
                201 => ['Approval Disclosure', '10/19/2020'],
                215 => ['Approval Disclosure', '08/17/2020'],
                228 => ['Final Disclosure', '08/25/2020'],
                234 => ['Final Disclosure', '09/25/2020'],
                236 => ['Final Disclosure', '08/11/2020'],
                241 => ['Final Disclosure', '08/25/2020'],
                248 => ['Approval Disclosure', '10/19/2020'],
                250 => ['Final Disclosure', '09/07/2020'],
                251 => ['Final Disclosure', '09/01/2020'],
                252 => ['Approval Disclosure', '10/19/2020'],
                264 => ['Approval Disclosure', '10/19/2020'],
                272 => ['Final Disclosure', '09/11/2020'],
                274 => ['Final Disclosure', '09/24/2020'],
                287 => ['Final Disclosure', '08/28/2020'],
                292 => ['Approval Disclosure', '01/04/2021'],
                294 => ['Approval Disclosure', '10/19/2020'],
                302 => ['Approval Disclosure', '08/17/2020'],
                317 => ['Final Disclosure', '10/11/2020'],
                319 => ['Approval Disclosure', '08/17/2020'],
                326 => ['Final Disclosure', '08/11/2020'],
                328 => ['Final Disclosure', '09/11/2020'],
                340 => ['Final Disclosure', '09/13/2020'],
                344 => ['Approval Disclosure', '09/04/2020'],
                349 => ['Approval Disclosure', '09/11/2020'],
                376 => ['Final Disclosure', '10/01/2020'],
                378 => ['Final Disclosure', '09/16/2020'],
                403 => ['Final Disclosure', '10/08/2020'],
                404 => ['Approval Disclosure', '08/17/2020'],
                411 => ['Final Disclosure', '9/24/2020'],
                412 => ['Final Disclosure', '10/1/2020'],
                413 => ['Final Disclosure', '09/25/2020'],
                422 => ['Final Disclosure', '09/21/2020'],
                423 => ['Sallie Mae Letter Disbursement Schedule', '8/14/2020'],
                424 => ['Final Disclosure', '10/04/2020'],
                432 => ['Final Disclosure', '08/27/2020'],
                433 => ['Approval Disclosure', '10/15/2020'],
                458 => ['Approval Disclosure', '10/19/2020'],
                463 => ['Final Disclosure', '08/25/2020'],
                482 => ['Final Disclosure', '09/17/2020'],
                484 => ['Final Disclosure', '09/21/2020'],
                496 => ['Final Disclosure', '08/10/2020'],
                508 => ['Final Disclosure', '09/24/2020'],
                509 => ['Approval Disclosure', '10/15/2020'],
                513 => ['Final Disclosure', '09/11/2020'],
                518 => ['Final Disclosure', '08/31/2020'],
                522 => ['Approval Disclosure', '10/01/2020'],
                523 => ['Approval Disclosure', '10/15/2020'],
                526 => ['Approval Disclosure', '10/26/2020'],
                527 => ['Approval Disclosure', '10/19/2020'],
                535 => ['Final Disclosure', '10/01/2020'],
                554 => ['Final Disclosure', '09/03/2020'],
                578 => ['Final Disclosure', '08/20/2020'],
                580 => ['Final Disclosure', '09/02/2020'],
                583 => ['Final Disclosure', '09/10/2020'],
                585 => ['Final Disclosure', '09/24/2020'],
                588 => ['Application Self-Certification'],
                590 => ['Approval Disclosure', '10/5/2020'],
                595 => ['Application Self-Certification'],
                601 => ['Final Disclosure', '10/8/2020'],
                613 => ['Final Disclosure', '10/21/2020'],
                654 => ['Final Disclosure', '09/11/2020'],
                655 => ['Approval Disclosure', '10/1/2020'],
                662 => ['Application Self-Certification'],
                706 => ['Final Disclosure', '10/8/2020'],
                726 => ['Approval Disclosure', '10/19/2020'],
                729 => ['Final Disclosure', '09/23/2020'],
                736 => ['Approval Disclosure', '11/05/2020'],
                740 => ['Approval Disclosure', '10/25/2020'],
                743 => ['Final Disclosure', '10/16/2020'],
                748 => ['Final Disclosure', '10/17/2020'],
                751 => ['Approval Disclosure', '01/04/2020'],
                755 => ['Final Disclosure', '09/24/2020'],
                760 => ['Final Disclosure', '10/23/2020'],
                761 => ['Final Disclosure', '10/08/2020'],
                765 => ['Final Disclosure', '12/21/2020'],
                770 => ['Final Disclosure', '10/15/2020'],
                773 => ['Final Disclosure', '11/5/2020'],
                780 => ['Final Disclosure', '10/23/2020'],
                781 => ['Final Disclosure', '11/02/2020'],
                784 => ['Final Disclosure', '10/22/2020'],
                785 => ['Approval Disclosure', '10/31/2020'],
                793 => ['Solicitation Disclosure'],
                796 => ['Final Disclosure', '9/30/2020'],
                801 => ['Final Disclosure', '10/29/2020'],
                804 => ['Final Disclosure', '10/25/2020'],
                812 => ['Final Disclosure', '9/15/2020'],
                814 => ['Final Disclosure', '11/2/2020'],
                816 => ['Final Disclosure', '3/15/2020'],
                821 => ['Final Disclosure', '10/9/2020'],
                825 => ['Final Disclosure', '10/14/2020'],
                842 => ['Final Disclosure', '11/01/2020'],
                844 => ['Final Disclosure', '10/6/2020'],
                845 => ['Final Disclosure', '11/1/2020'],
                847 => ['Final Disclosure', '9/11/2020'],
                848 => ['Final Disclosure', '10/21/2020'],
                851 => ['Final Disclosure', '4/15/2021'],
                856 => ['Final Disclosure', '09/23/2020'],
                858 => ['Approval Disclosure', '11/19/2020'],
                863 => ['Final Disclosure', '10/5/2020'],
                869 => ['Approval Disclosure', '02/15/2021'],
                870 => ['Final Disclosure', '10/04/2020'],
                871 => ['Final Disclosure', '11/02/2020'],
                875 => ['Approval Disclosure', '10/19/2020'],
                877 => ['Final Disclosure', '10/09/2020'],
                878 => ['Final Disclosure', '9/30/2020'],
                880 => ['Final Disclosure', '10/8/2020'],
                882 => ['Final Disclosure', '10/4/2020'],
            ];

            foreach ($dataToUpdate as $id => $dataPoint) {
                $rewardClaim = \App\LeveredgeRewardClaim::withTrashed()->find($id);

                $properties = [];

                if ($rewardClaim) {
                    $properties['document_submitted'] = $dataPoint[0];

                    if (count($dataPoint) == 2) {
                        $properties['disbursement_date'] = $dataPoint[1];
                    }
                }

                $rewardClaim->properties = $properties;
                $rewardClaim->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leveredge_reward_claims', function (Blueprint $table) {
            $table->dropColumn('properties');
        });
    }
}
