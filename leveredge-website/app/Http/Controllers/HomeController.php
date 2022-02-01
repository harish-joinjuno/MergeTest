<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function index(Request $request)
    {
        if ($request->user()->hasRole('admin')) {
            return $this->adminHome($request);
        }

        if ($request->user()->hasRole('partner')) {
            return $this->partnerHome($request);
        }

        if ($request->user()->hasRole('borrower')) {
            return $this->borrowerHome($request);
        }

        if ($request->user()->hasRole(Role::ROLE_NAME_REFERRAL_PROGRAM_USER)) {
            return redirect('/member/referral-program');
        }
    }

    protected function borrowerHome(Request $request)
    {
        if ($request->user()->hasNegotiationGroupUsers()) {
            return redirect()->route('member.dashboard');
        }

        return redirect()->route('user-profile.loan-type');
    }

    protected function adminHome(Request $request)
    {
        return redirect('/admin/dashboard');
    }

    protected function partnerHome(Request $request)
    {
        $partner = $request->user();

        if (!$partner->partner_profile) {
            return 'Your account has not been completely setup. Reach out to your contact at LeverEdge and ask them to fix this issue.';
        }

        switch ($partner->partner_profile->partner_type->type) {
            case 'Campus Ambassador':
                return $this->campusAmbassadorHome($request);

            case 'International Business Development Partner':
                return $this->internationalBusinessDevelopmentPartnerHome($request);

            default:
                return $this->regularPartnerHome($request);
        }
    }

    protected function campusAmbassadorHome(Request $request)
    {
        /** @var User $partner */
        $partner                        = $request->user();

        return view('partner.campus-ambassador.home', compact(
            'partner'
        ));
    }

    protected function regularPartnerHome(Request $request)
    {
        $partner = user();
        return view('partner.home')->with(compact('partner'));
    }

    protected function internationalBusinessDevelopmentPartnerHome(Request $request)
    {
        $partner = user();

        return view('partner.international-business-development-partner.home', compact('partner'));
    }
}
