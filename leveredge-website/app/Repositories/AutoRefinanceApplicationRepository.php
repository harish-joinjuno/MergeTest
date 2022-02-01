<?php


namespace App\Repositories;

use App\AutoRefinanceApplication;
use App\FaqGroup;
use App\Repositories\Contracts\AutoRefinanceApplicationRepositoryInterface;
use App\Repositories\Contracts\FaqGroupRepositoryInterface;

class AutoRefinanceApplicationRepository extends Repository implements AutoRefinanceApplicationRepositoryInterface
{
    protected $model = AutoRefinanceApplication::class;

    public function basicDetails(): array
    {
        $total_applications       = 2000;
        $completed_applications   = $this->model->where('completed_application',true)->count()+351;
        $payoff_amount            = $this->model->where('completed_application',true)->sum('payoff_amount');
        $additional_payoff_amount = $this->model->where('completed_application',true)->where(
            function($query) {
                $query->wherePayoffAmount(0)
                    ->orWhereNull('payoff_amount');
            })->count()                 * 19500;
        $random_amount            = 351 *19500;
        $refinance_amount         = number_format($payoff_amount + $additional_payoff_amount + $random_amount);
        $progress                 = ($completed_applications / $total_applications) * 100;
        $faqs                     = resolve(FaqGroupRepositoryInterface::class)->find(FaqGroup::AUTO_LOAN_REFINANCE)->questions;

        return compact(
   'total_applications',
'completed_applications',
            'refinance_amount',
            'progress',
            'faqs'
        );
    }
}
