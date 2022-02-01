<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $academic_year_id
 * @property int $negotiation_group_id
 * @property int $negotiation_group_eligible_profile_id
 * @property int $amount
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property array $properties
 *
 * @property-read User $user
 * @property-read AcademicYear $academicYear
 * @property-read NegotiationGroup $negotiationGroup
 * @property-read NegotiationGroupEligibleProfile $negotiationGroupEligibleProfile
 */
class NegotiationGroupUser extends Model
{
    use SoftDeletes;

    protected $casts = [
        'properties' => 'array',
    ];

    const STATUS_PENDING  = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DENIED   = 'denied';

    const NEGOTIATION_GROUP_ID_22_ELIGIBLE_PROFILE_ID = 20328;
    const NEGOTIATION_GROUP_ID_22_ACADEMIC_YEAR_ID = 7;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function negotiationGroup()
    {
        return $this->belongsTo(NegotiationGroup::class);
    }

    public function negotiationGroupEligibleProfile()
    {
        return $this->belongsTo(NegotiationGroupEligibleProfile::class);
    }

    public function nikhilSaysBlockFromDeal()
    {
        $profile = $this->user->profile;

        //Deny if member has access to deal
        if ($profile->has_access_to_deal) {
            return false;
        }

        // Allow anyone from Refinance
        if ($this->academicYear->id == 1) {
            return false;
        }

        // Allow any internationals to see the default messaging meant for them
        if ($profile->immigration_status == UserProfile::IMMIGRATION_STATUS_OTHER || $profile->immigration_status == UserProfile::IMMIGRATION_STATUS_DACA_RECIPIENT ) {
            return false;
        }

        // Allow Yale SOM for AY 2020-21
        if ($profile->grad_university_id == 23 && $profile->grad_degree_id == 1 && $this->academicYear->id == 3) {
            return false;
        }

        // Allow NYU for AY 2020-21
        if ($profile->grad_university_id == 16 && $profile->grad_degree_id == 1 && $this->academicYear->id == 3) {
            return false;
        }

        // Allow this list of Users
        $emails = [
            't.hernandezmitchell@gmail.com',
            'petekoehler13@gmail.com',
            'marieannprah@gmail.com',
            'arsalaa.ahmed@gmail.com',
            'chhabraanuj11@gmail.com',
            '11wolfh@gmail.com',
            'jarreaujoseph@gmail.com',
            'neil.pineda2@gmail.com',
            'kurt.ehrig@gmail.com',
            'hmrittenberg@gmail.com',
            'rona.beresh@yale.edu',
            'tlesnick@gmail.com',
            'sellis1606@gmail.com',
            'johnsalto1990@gmail.com',
            'jcianci21@gsb.columbia.edu',
            'ga679@stern.nyu.edu',
            'stephanie.schraier@kellogg.northwestern.edu',
            'ericvineyard@msn.com',
            'vsjr.dantuluri.2021@marshall.usc.edu',
            'thien.le@chicagobooth.edu',
            'lukechiang1@gmail.com',
            'stephanie.l.albino@gmail.com',
            'scigoldman@gmail.com',
            'patel.m.darshan@gmail.com',
            'lakenguza@gmail.com',
            'jbernstein@chicagobooth.edu',
            'rogers.lindsey95@gmail.com',
            'at868@cornell.edu',
            'dlochet@med.miami.edu',
            'emilybergan@gmail.com',
            'preritk20@gmail.com',
            'catronjer@gmail.com',
            'raybeneventano@gmail.com',
            'jcianci21@gsb.columbia.edu',
            'lonnie1892@gmail.com',
            'jackie.sullivan15@gmail.com',
            'jcianci21@gsb.columbia.edu',
            'madelinehend16@gmail.com',
            'qgarrick731@gmail.com',
            'cwp31@georgetown.edu',
            'vikas.bhaiya@gmail.com',
            'destinedforgreatness2011@gmail.com',
            'anthonyerussonyc@gmail.com',
            'youngsamuelchoi@gmail.com',
            'taryndwaters@gmail.com',
            'bolanosgraciela@gmail.com',
            'levinsonda@gmail.com',
            'charleschautran@gmail.com',
            'rosesoflove09@gmail.com',
            'shashwatssinha@gmail.com',
            'kahlil.morse@yale.edu',
            'joshteague1384@gmail.com',
            'biankawhite034@gmail.com',
            'ayamnouiouat@berkeley.edu',
            'rajivkamaria@gmail.com',
            'spatarojordan@gmail.com',
            'nataliemayfieldanderson@gmail.com',
            'gursean.singh@gmail.com',
            'marshall.bryant305@gmail.com',
            'mtkramm1@gmail.com',
            'fischersalina78@gmail.com',
            'mscoro65@gmail.com',
            'gilliangarbus@gmail.com',
            'alex.lautzenheiser@gmail.com',
            'bfacemire14@gmail.com',
            'brycestrauss@gmail.com',
            'a.cocleaza@gmail.com',
            'alyssasoren@gmail.com',
            'princeagye42@gmail.com',
            'qgarrick731@gmail.com',
            'spatarojordan@gmail.com',
        ];
        if ( in_array( strtolower($this->user->email) , $emails)  ) {
            return false;
        }

        // Allow Wharton (for Wednesday) for AY 2020-21
//        if($profile->grad_university_id == 17 && $profile->grad_degree_id = 1 && $this->academicYear->id == 3){
//            return false;
//        }

        // Block Everyone Else from seeing the default negotiation group card
        return true;
    }

    public function addToNegotiationGroup22()
    {
        $negotiationGroupUser                                        = new NegotiationGroupUser();
        $negotiationGroupUser->user_id                               = $this->user_id;
        $negotiationGroupUser->negotiation_group_id                  = 22;
        $negotiationGroupUser->negotiation_group_eligible_profile_id = self::NEGOTIATION_GROUP_ID_22_ELIGIBLE_PROFILE_ID;
        $negotiationGroupUser->academic_year_id                      = self::NEGOTIATION_GROUP_ID_22_ACADEMIC_YEAR_ID;
        $negotiationGroupUser->status                                = 'pending';

        $negotiationGroupUser->save();

        return $this->user();
    }
}
