<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\ActionNotification;
use App\ActionNotifications\DisplayActionNotifications;
use App\DismissedActionNotification;
use App\NegotiationGroupUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MemberDashboardController extends Controller
{
    public function __invoke()
    {
        DisplayActionNotifications::all();
        $enrolledNegotiationGroupUsers = user()->negotiationGroupUsers;

        // Start with all Academic Years
        $eligibleAcademicYears = AcademicYear::all()->keyBy('id');

        // Remove any that the member is already enrolled in
        foreach ($enrolledNegotiationGroupUsers as $negotiationGroupUser) {
            foreach ($eligibleAcademicYears as $academicYear) {
                if ($negotiationGroupUser->academicYear && $negotiationGroupUser->academicYear->id == $academicYear->id) {
                    $eligibleAcademicYears->forget($academicYear->id);
                }
            }
        }

        // Remove any that the member would not be eligible to join
        foreach ($eligibleAcademicYears as $academicYear) {
            $negotiationGroupEligibleProfile = null;
            foreach ($academicYear->negotiationGroups as $negotiationGroup) {
                $negotiationGroupEligibleProfile = user()->profile->matchingEligibleProfile($negotiationGroup);
                if ($negotiationGroupEligibleProfile) {
                    break;
                }
            }
            if ($negotiationGroupEligibleProfile == null) {
                $eligibleAcademicYears->forget($academicYear->id);
            }
        }

        $eligibleForRewards = method_exists(user(), 'hasAccessedADealWithLeverEdgeRewards') ?
            user()->hasAccessedADealWithLeverEdgeRewards() : false;

        return view('member.dashboard')->with([
            'enrolledNegotiationGroupUsers' => $enrolledNegotiationGroupUsers,
            'eligibleAcademicYears'         => $eligibleAcademicYears,
            'eligibleForRewards'            => $eligibleForRewards,
        ]);
    }

    public function dismissNotification(ActionNotification $actionNotification)
    {
        $data = [
            'user_id'                => user()->id,
            'action_notification_id' => $actionNotification->id,
        ];

        DismissedActionNotification::create($data);

        return response()->json(['success' => true]);
    }

    public function redirectToNegotiationGroup(AcademicYear $academicYear)
    {
        $negotiationGroupUser = NegotiationGroupUser::where('user_id',user()->id)->where('academic_year_id',$academicYear->id)->firstOrFail();

        return redirect('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id);
    }
}
