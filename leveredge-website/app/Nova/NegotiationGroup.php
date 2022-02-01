<?php

namespace App\Nova;

use App\Nova\Traits\NegotiationGroupsAndAcademicYearsFields;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use NovaItemsField\Items;

class NegotiationGroup extends Resource
{
    use NegotiationGroupsAndAcademicYearsFields;

    public static $model = \App\NegotiationGroup::class;

    public static $title = 'name';

    public static $group = 'Negotiation Group';

    public static $search = [
        'id', 'name', 'slug', 'priority', 'deal_confidence', 'academic_years.name',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Text::make('Slug')->sortable(),
            Number::make('Priority')->sortable(),
            Number::make('Deal Confidence')->min(0)->max(100)
                ->displayUsing(function ($value) {
                    return $value . '%';
                })->sortable(),
            Text::make('Redirect Url')->nullable(),

            BelongsTo::make('Academic Year', 'academicYear')->sortable(),

            HasMany::make('Eligible Profiles', 'eligibleProfiles', \App\Nova\NegotiationGroupEligibleProfile::class),
            HasMany::make('Announcements', 'announcements', \App\Nova\NegotiationGroupAnnouncement::class),

            MorphOne::make('Mailable', 'mailable', MailchimpAutomatedCampaignMailable::class),

            new Panel('Dashboard Fields', $this->dashboardFields()),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->select(['negotiation_groups.*', 'academic_years.name as academic_year_name'])
            ->join('academic_years', 'negotiation_groups.academic_year_id', '=', 'academic_years.id');

        return $query;
    }
}
