<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * @property string $immigration_status
 * @property string $credit_score_range
 * @property string $display_on_page
 * @property int    $action_notification_id
 * @property int    $negotiation_group_id
 * @property int    $academic_year_id
 * @property int    $university_id
 * @property int    $degree_id
 * @property int    $grad_university_id
 * @property int    $grad_degree_id
 *
 * @property-read ActionNotification[] $actionNotification
 * @property-read NegotiationGroup[]   $negotiationGroup
 * @property-read AcademicYear[]       $academicYear
 * @property-read University[]         $university
 * @property-read Degree[]             $degree
 * @property-read University[]         $gradUniversity
 * @property-read Degree[]             $gradDegree
 */
class SimpleActionNotificationRule extends Model
{
    public function actionNotification()
    {
        return $this->belongsTo(ActionNotification::class, 'action_notification_id');
    }

    public function negotiationGroup()
    {
        return $this->belongsTo(NegotiationGroup::class, 'negotiation_group_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function degree()
    {
        return $this->belongsTo(UndergraduateDegree::class, 'degree_id');
    }

    public function gradUniversity()
    {
        return $this->belongsTo(University::class, 'grad_university_id');
    }

    public function gradDegree()
    {
        return $this->belongsTo(GradDegree::class, 'grad_degree_id');
    }
}
