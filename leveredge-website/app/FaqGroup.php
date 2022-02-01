<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $internal_name
 * @property string $question
 * @property string $answer
 */
class FaqGroup extends Model
{

//    const COMPARISON_PAGE_FOR_STUDENTS_AT_COMMONBOND_ELIGIBLE_MBA_PROGRAMS_GROUP_1          = 2;
//    const COMPARISON_PAGE_FOR_GRAD_STUDENTS_AT_NON_COMMONBOND_ELIGIBLE_MBA_PROGRAMS_GROUP_2 = 3;

    const COMMONBOND_DEAL_DETAIL_PAGE                                                       = 1;
    const CREDIBLE_DEAL_DETAIL_PAGE                                                         = 5;
    const EARNEST_DEAL_DETAIL_PAGE_UNDERGRAD                                                = 6;
    const EARNEST_DEAL_DETAIL_PAGE_GRAD                                                     = 7;

    const GRADUATE_PAGE                                                                     = 12;
    const UNDERGRADUATE_PAGE                                                                = 4;
    const REFI_LOAN_DETAIL_PAGE                                                             = 21;

    const RECOMMENDED_VARIABLE_FOR_CB_ELIGIBLE                                              = 8;
    const RECOMMENDED_FIXED_FOR_CB_ELIGIBLE                                                 = 9;
    const RECOMMENDED_VARIABLE_FOR_NON_CB_GRADS                                             = 10;
    const RECOMMENDED_FIXED_FOR_NON_CB_GRADS                                                = 11;

    const RECOMMENDED_MEDICAL_IN_FR_CITIES_REFI                                             = 13;
    const RECOMMENDED_MEDICAL_OUTSIDE_FR_CITIES_REFI                                        = 14;
    const RECOMMENDED_NON_MEDICAL_IN_FR_CITIES_REFI                                         = 15;
    const RECOMMENDED_NON_MEDICAL_OUTSIDE_FR_CITIES_REFI                                    = 16;

    const LAUREL_ROAD_DEAL_DETAIL_PAGE_REFI                                                 = 17;
    const EARNEST_DEAL_DETAIL_PAGE_REFI                                                     = 18;
    const FIRST_REPUBLIC_DEAL_DETAIL_PAGE_REFI                                              = 19;

    const INTERNATIONAL_HEALTH_INSURANCE                                                    = 20;
    const BAR_PREP_PUBLIC_PAGE                                                              = 23;
    const AUTO_LOAN_REFINANCE                                                               = 24;
    const SCHOLARSHIP_PAGES                                                                 = 25;

    const AY_2021_22                                                                        = 26;
    const INTERNATIONAL_REFINANCE                                                           = 27;
    const INTERNATIONAL_AY_2021_22                                                          = 28;
    const SAT_ACT_TEST_PREP                                                                 = 29;

    const FEDERAL_STUDENT_LOAN_TRACKER                                                      = 30;

    public $fillable = [
        'name',
    ];

    protected $with = [
        'questions',
    ];

    public function questions()
    {
        return $this->belongsToMany(Faq::class, 'frequently_asked_group_questions');
    }
}
