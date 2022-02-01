<?php


namespace App\Http\Controllers\Webhooks;

use App\AcademicYear;
use App\Events\UserProfileUpdated;
use App\Http\Controllers\Controller;
use App\Jobs\CompleteFlow\SendLastJoinedNegotiationGroupWelcomeEmail;
use App\Mail\CreatePasswordEmail;
use App\Notifications\SlackLeadSignupNotification;
use App\Traits\registersBorrowers;
use App\User;
use App\UserProfile;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class FacebookController extends Controller
{
    use registersBorrowers;

    public function __invoke(Request $request)
    {
        Log::channel('facebook_webhook')->debug('Received webhook', $request->all());
        $data   = $request->all();
        $config = config('services.facebook');

        $api = Api::init($config['app_id'], $config['lead_client_secret'], $config['page_ll_access_token']);
        $api->setLogger(new CurlLogger());

        $citizenshipStatusMaps = [
            'u.s._citizen_or_permanent_resident'  => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
            'conditional_u.s._permanent_resident' => UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT,
            'daca_recipient'                      => UserProfile::IMMIGRATION_STATUS_DACA_RECIPIENT,
            'international'                       => UserProfile::IMMIGRATION_STATUS_OTHER,
        ];

        $creditScoreMaps = [
            'above_650'    => UserProfile::CREDIT_SCORE_BETWEEN_700_AND_749,
            'below_650'    => UserProfile::CREDIT_SCORE_BETWEEN_550_AND_649,
            "i_don't_know" => null,
        ];

        $fields = [];
        $params = [];

        $leadgenResponse = (new Lead($data['entry'][0]['changes'][0]['value']['leadgen_id']))->getSelf(
            $fields,
            $params
        )->exportAllData();

        Log::channel('facebook_webhook')->debug('Lead Gen Response', $leadgenResponse);
        $formData = collect(array_values($leadgenResponse['field_data']));

        $citizenshipStatus = $citizenshipStatusMaps[$formData->where('name', 'citizenship_status')->first()['values'][0]];
        $email             = $formData->where('name', 'email')->first()['values'][0];
        $creditScore       = $creditScoreMaps[$formData->where('name', 'credit_score')->first()['values'][0]];
        $isMedical         = $formData->where('name', 'are_you_a_medical_professional?')->first()['values'][0];
        $fullName          = $formData->where('name', 'full_name')->first()['values'][0];

        if (! User::where('email', $email)->exists()) {
            $user = $this->create([
                'email'    => $email,
                'password' => bcrypt(Str::random(8)),
            ]);

            $this->createBorrowerProfile($user);
            $nameDetails = explode(' ', $fullName);
            $user->refresh();

            $user->first_name = $nameDetails[0];
            $user->last_name  = isset($nameDetails[1]) ? $nameDetails[1] : null;
            $user->name       = $fullName;
            $user->save();

            $profile                     = $user->profile;
            $profile->credit_score       = $creditScore;
            $profile->immigration_status = $citizenshipStatus;
            $profile->save();
            $academicYear                = AcademicYear::find(AcademicYear::ACADEMIC_YEAR_REFINANCE_ID);

            $profile->placeInEligibleNegotiationGroups($academicYear);

            $profile->is_medical = $isMedical === 'yes';

            event(new UserProfileUpdated($user));
            Mail::to($user->email)->send(new CreatePasswordEmail($user));
            dispatch(new SendLastJoinedNegotiationGroupWelcomeEmail($user));

            Notification::route('slack', config('services.slack.new_facebook_lead_url'))
                ->notify(new SlackLeadSignupNotification([
                    'citizenship_status' => $citizenshipStatus,
                    'credit_score'       => $creditScore,
                    'is_medical'         => $isMedical,
                    'email'              => $email,
                    'name'               => $fullName,
                ]));
        }

        return response()->json(true);
    }
}
