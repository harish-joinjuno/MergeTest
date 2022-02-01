<?php


namespace App\Http\Controllers;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SociallyPoweredController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $deal = Deal::where('slug', $request->deal_slug)->first();
        $user = User::firstOrCreate([
            'email' => 'sociallypowered@joijuno.com',
        ], [
            'name'     => 'Socially Powered',
            'password' => bcrypt(Str::random(8)),
        ]);
        if ($deal) {
            $access_the_deal                 = new AccessTheDeal();
            $access_the_deal->deal_id        = $deal->id;
            $access_the_deal->loan_status_id = DealStatus::DEFAULT_DEAL_STATUS_ID;
            $access_the_deal->user_id        = $user->id;
            $access_the_deal->save();

            return response()->json([
                'accessTheDealId' => $access_the_deal->id,
            ]);
        }

        return response()->json([
            'error' => 'Deal does not exists',
        ], 404);
    }

    public function redirectToLender($accessTheDealId)
    {
        /** @var AccessTheDeal $accessTheDeal */
        $accessTheDeal = AccessTheDeal::find($accessTheDealId);

        return view('redirect-header', ['redirectUrl' => $accessTheDeal->getRedirectUrl()]);
    }

    public function getDealsDetails(Request $request)
    {
        $response = [];
        if ($request->filled('accessTheDeals')) {
            foreach ($request->accessTheDeals as $accessTheDeal) {
                /** @var AccessTheDeal $accessTheDeal */
                $accessTheDealObj                 = AccessTheDeal::find($accessTheDeal['access_the_deal_id']);
                $response[]                       = [
                    'deal'           => $accessTheDeal['deal'],
                    'loan_amount'    => $accessTheDealObj->loan_amount,
                    'loan_status_id' => $accessTheDealObj->loan_status_id,
                ];
            }
        }

        return response()->json($response);
    }
}
