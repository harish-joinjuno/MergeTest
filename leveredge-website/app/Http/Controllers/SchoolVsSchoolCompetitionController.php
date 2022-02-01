<?php

namespace App\Http\Controllers;

use App\Events\SchoolVsSchoolCompetitionEntered;
use App\Http\Requests\ShareViaEmailRequest;
use App\Jobs\SchoolVSchoolShareViaEmailJob;
use App\Mail\SchoolVSchoolShareViaEmail;
use App\SchoolVsSchoolCompetition;
use App\SchoolVsSchoolCompetitionEntrant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class SchoolVsSchoolCompetitionController extends Controller
{
    public function __construct()
    {
        View::share('hide_navigation_menu',true);
    }

    public function showCompetition(Request $request, $competition_id)
    {
        $competition = SchoolVsSchoolCompetition::with('entrants')->findOrFail($competition_id);

        return view('school-vs-school-competition.show-competition')->with(
            [
                'competition'            => $competition,
            ]
        );
    }

    public function registerEntrantToCompetition(Request $request, $competition_id)
    {
        // If user already exists, send straight to the verify email page or the competition page
        $entrant = SchoolVsSchoolCompetitionEntrant::where('email',$request->email)->first();
        if ($entrant) {
            if ($entrant->first_name) {
                return redirect('competition/' . $entrant->id);
            }

            return redirect('competition/verify-email');
        }

        $competition = SchoolVsSchoolCompetition::findOrFail($competition_id);

        $request->validate([
            'email' => 'required|email',
        ]);

        $entrant                                  = new SchoolVsSchoolCompetitionEntrant();
        $entrant->school_vs_school_competition_id = $competition_id;
        $entrant->email                           = $request->email;
        $entrant->verified                        = false;
        $entrant->verification_code               = $this->getUniqueVerificationCode();
        $entrant->save();

        event (new SchoolVsSchoolCompetitionEntered($entrant));

        return redirect('competition/verify-email');
    }

    protected function getUniqueVerificationCode()
    {
        $code = Str::random(8);
        if (SchoolVsSchoolCompetitionEntrant::where('verification_code',$code)->exists()) {
            return $this->getUniqueVerificationCode();
        }

        return $code;
    }

    public function showVerifyEmailRequest()
    {
        return view('school-vs-school-competition.request-email-verification');
    }

    public function verifyEmail(Request $request ,$verification_code)
    {
        $entrant = SchoolVsSchoolCompetitionEntrant::where('verification_code',$verification_code)->firstOrFail();

        if ($entrant->first_name) {
            return redirect('competition/' . $entrant->id);
        }
        $entrant->verified = true;
        $entrant->save();

        return redirect('competition/' . $entrant->id . '/last-step');
    }

    public function showLastStep(Request $request, $competition_entrant_id)
    {
        $entrant = SchoolVsSchoolCompetitionEntrant::findOrFail($competition_entrant_id);

        return view('school-vs-school-competition.show-last-step')->with(['entrant' => $entrant]);
    }

    public function saveName(Request $request, $competition_entrant_id)
    {
        $entrant                  = SchoolVsSchoolCompetitionEntrant::findOrFail($competition_entrant_id);
        $validatedDate = $request->validate([
            'first_name'      => 'required',
            'true_statements' => 'required|array|min:' . count($entrant->competition->true_statements),
            'colloquial_slug' => 'required',
        ]);

        $entrant->first_name      = $request->first_name;
        $entrant->colloquial_slug = $request->colloquial_slug;
        $entrant->save();

        return redirect('competition-entrant/' . $entrant->id);
    }

    public function showEntrant(Request $request, $competition_entrant_id)
    {
        $entrant = SchoolVsSchoolCompetitionEntrant::with('competition.entrants')->findOrFail($competition_entrant_id);

        $team_count = SchoolVsSchoolCompetitionEntrant::where('school_vs_school_competition_id',$entrant->school_vs_school_competition_id)
            ->where('colloquial_slug',$entrant->colloquial_slug)->count();

        if ($team_count >= $entrant->competition->target_number_of_students) {
            $sign_ups_remaining = 0;
        } else {
            $sign_ups_remaining = $entrant->competition->target_number_of_students - $team_count;
        }

        return view('school-vs-school-competition.show-entrant')->with(['entrant' => $entrant, 'sign_ups_remaining' => $sign_ups_remaining]);
    }

    public function savePartyHost(Request $request, $competition_entrant_id)
    {
        $request->validate([
            'wants_to_host_party'  => 'accepted',
            'recommended_location' => 'required',
        ]);

        $entrant                       = SchoolVsSchoolCompetitionEntrant::with('competition.entrants')->findOrFail($competition_entrant_id);
        $entrant->wants_to_host_party  = $request->wants_to_host_party;
        $entrant->recommended_location = $request->recommended_location;
        $entrant->save();

        return redirect('competition/' . $entrant->id );
    }

    /**
     * @param ShareViaEmailRequest $request
     * @param $competition_entrant_id
     * @return RedirectResponse
     */
    public function shareViaEmail(ShareViaEmailRequest $request, $competition_entrant_id)
    {
        $entrant = SchoolVsSchoolCompetitionEntrant::with('competition.entrants')->findOrFail($competition_entrant_id);

        dispatch(new SchoolVSchoolShareViaEmailJob($entrant, $request->emails));

        return back();
    }

    private function computeEntrantsToWin(\Illuminate\Support\HigherOrderCollectionProxy $competition, ?string $team_number)
    {
    }
}
