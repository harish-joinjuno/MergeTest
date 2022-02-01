<?php

namespace App\Http\Controllers;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\LeveredgeRewardClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CredibleAttributionController extends Controller
{
    public function index()
    {
        /** @var LeveredgeRewardClaim[] $credibleClaims */
        /** @var LeveredgeRewardClaim $claim */

        $earnestClaimsOrFake = [73,356,519];

        $credibleClaims = LeveredgeRewardClaim::with('accessTheDeal','user.accessTheDeals','distributions')
            ->where('deal_id',3)
            ->whereDoesntHave('distributions')
            ->whereNotIn('id', $earnestClaimsOrFake)
            ->whereDate('created_at','<',now()->subDays(20))
            ->get();

        $seniorityOfStatus = [
            0,
            DealStatus::CLICKED_TO_PROVIDER_ID,
            DealStatus::RECEIVED_PRELIMINARY_QUOTES_ID,
            DealStatus::WITHDRAWN_BY_LENDER,
            DealStatus::SUBMITTED_COMPLETE_APPLICATION,
            DealStatus::DOCUMENT_SUBMITTED,
            DealStatus::APPROVED_BY_LENDER,
            DealStatus::CERTIFIED,
            DealStatus::SIGNED_THE_LOAN,
        ];

        $latestDealStatus    = [];
        $latestAccessTheDeal = [];

        foreach ($credibleClaims as $claim) {
            $latestDealStatus[$claim->id] = 0;

            /** @var AccessTheDeal $accessTheDeal */
            // Let's Figure Out The Latest Loan Status ID
            foreach ($claim->user->accessTheDeals as $accessTheDeal) {
                if ($accessTheDeal->deal_id == 3) {
                    $orderOfCurrentLatest   = array_search($latestDealStatus[$claim->id],$seniorityOfStatus);
                    $orderOfPotentialLatest = array_search($accessTheDeal->loan_status_id,$seniorityOfStatus);
                    if ($orderOfPotentialLatest > $orderOfCurrentLatest) {
                        $latestDealStatus[$claim->id]    = $accessTheDeal->loan_status_id;
                        $latestAccessTheDeal[$claim->id] = $accessTheDeal;
                    }
                }
            }
        }

        return view('admin.credible-reports.credible-attribution-issues')->with(compact([
            'credibleClaims',
            'latestDealStatus',
            'latestAccessTheDeal',
        ]));
    }

    public function indexV2()
    {
        // Only Admins or Jack
        if (!Auth::check()) {
            abort(403);
        }

        if (!user()->hasAnyRole(['admin','credible-lender'])) {
            abort(403);
        }

        /** @var LeveredgeRewardClaim[] $credibleClaims */
        /** @var LeveredgeRewardClaim $claim */

        $earnestClaimsOrFake = [73,356,519];

        $credibleClaims = LeveredgeRewardClaim::with('accessTheDeal','user.accessTheDeals','distributions')
            ->where('deal_id',3)
            ->whereDoesntHave('user',function($query) {
                $query->whereHas('accessTheDeals',function($query) {
                    $query->where('deal_id',3)->where('loan_status_id',8);
                });
            })
            ->whereNotIn('id', $earnestClaimsOrFake)
            ->whereDate('created_at','<',now()->subDays(20))
            ->get();

        $seniorityOfStatus = [
            0,
            DealStatus::CLICKED_TO_PROVIDER_ID,
            DealStatus::RECEIVED_PRELIMINARY_QUOTES_ID,
            DealStatus::WITHDRAWN_BY_LENDER,
            DealStatus::SUBMITTED_COMPLETE_APPLICATION,
            DealStatus::DOCUMENT_SUBMITTED,
            DealStatus::APPROVED_BY_LENDER,
            DealStatus::CERTIFIED,
            DealStatus::SIGNED_THE_LOAN,
        ];

        $latestDealStatus    = [];
        $latestAccessTheDeal = [];

        foreach ($credibleClaims as $claim) {
            $latestDealStatus[$claim->id] = 0;

            /** @var AccessTheDeal $accessTheDeal */
            // Let's Figure Out The Latest Loan Status ID
            foreach ($claim->user->accessTheDeals as $accessTheDeal) {
                if ($accessTheDeal->deal_id == 3) {
                    $orderOfCurrentLatest   = array_search($latestDealStatus[$claim->id],$seniorityOfStatus);
                    $orderOfPotentialLatest = array_search($accessTheDeal->loan_status_id,$seniorityOfStatus);
                    if ($orderOfPotentialLatest > $orderOfCurrentLatest) {
                        $latestDealStatus[$claim->id]    = $accessTheDeal->loan_status_id;
                        $latestAccessTheDeal[$claim->id] = $accessTheDeal;
                    }
                }
            }
        }

        return view('admin.credible-reports.credible-attribution-issues')->with(compact([
            'credibleClaims',
            'latestDealStatus',
            'latestAccessTheDeal',
        ]));
    }

    public function potentialCases()
    {
        $accessTheDeals = AccessTheDeal::with(['user','dealStatus'])
            ->where('deal_id',3)
            ->where('created_at','<',now()->subDays(20))
            ->whereDoesntHave('user',function ($query) {
                $query->has('rewardClaims');
            })
            ->where(function ($query) {
                $query->where('loan_status_id',DealStatus::DOCUMENT_SUBMITTED)
                    ->orWhere('loan_status_id',DealStatus::WITHDRAWN_BY_LENDER)
                    ->orWhere('loan_status_id',DealStatus::CERTIFIED);
//                    ->orWhere('loan_status_id',DealStatus::SUBMITTED_COMPLETE_APPLICATION);
            })->get();

        return view('admin.credible-reports.credible-attribution-potential-cases')->with(compact([
            'accessTheDeals',
        ]));
    }
}
