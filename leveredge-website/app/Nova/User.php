<?php

namespace App\Nova;

use App\ContractType;
use App\Nova\Actions\MakePartner;
use App\PartnerType;
use Illuminate\Http\Request;
use KABBOUCHI\NovaImpersonate\Impersonate;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    public static $model = 'App\User';

    public static $title = 'name';

    public static $group = 'Admin';

    public static $search = [
        'id', 'name', 'email',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('First Name')
                ->sortable()
                ->rules( 'max:255'),

            Text::make('Last Name')
                ->sortable()
                ->rules('max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Impersonate::make($this)->withMeta([
                'redirect_to' => '/home',
            ]),

            Text::make('Primary Role', function () {
                return $this->primary_role->name ?? null;
            })->readonly()->exceptOnForms(),

            HasOne::make('User Profile','profile')->nullable(),

            // Relationships
            BelongsToMany::make('Roles', 'roles', 'App\Nova\Role'),

            HasMany::make('Negotiation Group Users', 'negotiationGroupUsers'),
            HasMany::make('Negotiation Group User Exclusions', 'negotiationGroupUserExclusions'),
            HasMany::make('Referral Program Users', 'referralProgramUsers'),
            HasMany::make('Received Payments', 'receivedPayments', 'App\Nova\Payment'),

            HasMany::make('Referral Reward Claims', 'referralRewardClaims'),

            BelongsTo::make('Referred By', 'referredBy', 'App\Nova\User')->searchable()->nullable(),

            HasMany::make('Referred Users', 'referredUsers', 'App\Nova\User'),

            HasMany::make('Access The Deals','accessTheDeals','App\Nova\AccessTheDeal'),

            HasMany::make('Reward Claims','rewardClaims','App\Nova\LeveredgeRewardClaim'),
            HasMany::make('Screenshot Claims','screenshotClaims','App\Nova\ScreenshotClaim'),

            MorphMany::make('Question Flow Responders', 'questionFlowResponders', QuestionFlowResponder::class),
            MorphMany::make('Question Page Responders', 'questionPageResponders', QuestionPageResponder::class),
            MorphMany::make('Question Flow Validation Errors', 'questionFlowValidationErrors', QuestionFlowValidationError::class),
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
        return [
            (new MakePartner()),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->email === 'shehzan.maredia@duke.edu') {
            return $query->whereHas('partnerProfile', function($q) {
                return $q->whereContractTypeId(ContractType::TYPE_CAMPUS_AMBASSADOR_ID)
                    ->wherePartnerTypeId(PartnerType::TYPE_CAMPUS_AMBASSADOR_ID);
            })->get();
        }

        return $query;
    }
}
