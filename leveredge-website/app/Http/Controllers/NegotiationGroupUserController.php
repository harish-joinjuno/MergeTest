<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Events\UserPlacedInNegotiationGroup;
use App\NegotiationGroup;
use App\NegotiationGroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NegotiationGroupUserController extends Controller
{

    public function join(Request $request)
    {
        $user          = user();
        $validatedData = $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        $academicYear = AcademicYear::find($validatedData['academic_year_id']);

        if ($academicYear->join_group_redirect) {
            return redirect()->to((new $academicYear->join_group_redirect)->url());
        }
        $user->profile->placeInEligibleNegotiationGroups($academicYear);
        event(new UserPlacedInNegotiationGroup($user));


        $negotiationGroupUser = NegotiationGroupUser::where('academic_year_id',$academicYear->id)
            ->where('user_id',$user->id)->first();

        if ($negotiationGroupUser->negotiationGroup->redirect_url) {
            return redirect($negotiationGroupUser->negotiationGroup->redirect_url);
        }

        return redirect('member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id);
    }

    public function leave(Request $request)
    {
        $validatedData = $request->validate([
           'negotiation_group_user_id' => 'required|exists:negotiation_group_users,id',
        ]);

        $negotiationGroupUser = NegotiationGroupUser::find($validatedData['negotiation_group_user_id']);

        if ($negotiationGroupUser->user_id != user()->id) {
            abort(500);
        }

        NegotiationGroupUser::destroy($validatedData['negotiation_group_user_id']);

        return redirect('member/dashboard');
    }
}
