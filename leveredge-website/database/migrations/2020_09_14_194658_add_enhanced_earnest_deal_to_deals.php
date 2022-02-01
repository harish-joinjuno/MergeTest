<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddEnhancedEarnestDealToDeals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('deals', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement()->change();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        if (env('APP_ENV') == 'production') {
            $deal                            = \App\Deal::where('slug',\App\Deal::DEAL_EARNEST_GRAD_STUDENT_LOAN_20_21_SLUG)->first()->replicate();
            $deal->id                        = 15;
            $deal->name                      = 'Earnest Graduate Loan (Enhanced)';
            $deal->percentage_of_loan_amount = 1.8;
            $deal->slug                      = \App\Deal::DEAL_ENHANCED_EARNEST_GRAD_STUDENT_LOAN_20_21_SLUG;
            $deal->reward_program            = 'App\RewardPrograms\Concretes\EarnestEnhancedGraduateStudentLoanRewardProgram';
            $deal->revenue_calculator        = 'App\Partnerships\Concretes\RevenueCalculator\EarnestEnhancedGraduateLoan';
            $deal->save();

            $accessTheDeals = \App\AccessTheDeal::whereHas('user',function(\Illuminate\Database\Eloquent\Builder $query) {
                $query->whereIn('email',[
                    'takara.ashley@gmail.com',
                    'jacob.lefker@gmail.com',
                    'sam.gersten@gmail.com',
                ]);
            })
                ->where('deal_id',7)
                ->where('loan_status_id',8)
                ->get();

            foreach ($accessTheDeals as $accessTheDeal) {
                $accessTheDeal->deal_id = $deal->id;
                $accessTheDeal->save();
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
        $deal = \App\Deal::where('slug',\App\Deal::DEAL_ENHANCED_EARNEST_GRAD_STUDENT_LOAN_20_21_SLUG)->first();

        $accessTheDeals = \App\AccessTheDeal::whereHas('user',function(\Illuminate\Database\Eloquent\Builder $query) {
            $query->whereIn('email',[
                'takara.ashley@gmail.com',
                'jacob.lefker@gmail.com',
                'sam.gersten@gmail.com',
            ]);
        })
            ->where('deal_id',$deal->id)
            ->where('loan_status_id',8)
            ->get();

        foreach ($accessTheDeals as $accessTheDeal) {
            $accessTheDeal->deal_id = 7;
            $accessTheDeal->save();
        }

        $deal->delete();
    }
}
