<?php

namespace App\Nova;

use App\Partnerships\Contracts\ContractTypeDefinitionInterface;
use App\Partnerships\Contracts\RevenueCalculatorInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Symfony\Component\Finder\Finder;

class ContractType extends Resource
{
    public static $model = \App\ContractType::class;

    public static $title = 'type';

    public static $group = 'Partner Management';

    public static $search = [
        'id', 'type',
    ];

    public function fields(Request $request)
    {
        $namespace                           = app()->getNamespace();
        $loanAmountResources                 = [];
        $loanAmountSharingDirectory          = base_path('app/Partnerships/Concretes/LoanAmountSharing/');
        $loanAmountFiles                     = (new Finder)->files()->in($loanAmountSharingDirectory);
        foreach ($loanAmountFiles as $resource) {
            $resource = $namespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($resource->getPathname(), app_path() . DIRECTORY_SEPARATOR)
                );
            if (is_subclass_of($resource, ContractTypeDefinitionInterface::class) && $resource !== 'App\Partnerships\Concretes\LoanAmountSharing\Main') {
                $loanAmountResources[$resource] = $resource::getTitle();
            }
        }

        $loanAmountResources = collect($loanAmountResources)->sort()->toArray();

        $netRevenueSharingDirectory       = base_path('app/Partnerships/Concretes/NetRevenueSharing/');
        $netRevenueResources              = [];
        $netRevenueFiles                  = (new Finder)->files()->in($netRevenueSharingDirectory);
        foreach ($netRevenueFiles as $resource) {
            $resource = $namespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($resource->getPathname(), app_path() . DIRECTORY_SEPARATOR)
                );

            if (is_subclass_of($resource, ContractTypeDefinitionInterface::class) && $resource !== 'App\Partnerships\Concretes\NetRevenueSharing\Main') {
                $netRevenueResources[$resource] = $resource::getTitle();
            }
        }

        $netRevenueResources = collect($netRevenueResources)->sort()->toArray();

        $premiumSharingDirectory       = base_path('app/Partnerships/Concretes/PremiumSharingInsuranceOnly/');
        $premiumResources              = [];
        $premiumFiles                  = (new Finder)->files()->in($premiumSharingDirectory);
        foreach ($premiumFiles as $resource) {
            $resource = $namespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($resource->getPathname(), app_path() . DIRECTORY_SEPARATOR)
                );

            if (is_subclass_of($resource, ContractTypeDefinitionInterface::class) && $resource !== 'App\Partnerships\Concretes\PremiumSharingInsuranceOnly\Main') {
                $premiumResources[$resource] = $resource::getTitle();
            }
        }

        $premiumResources = collect($premiumResources)->sort()->toArray();

        $resources = array_merge($loanAmountResources, $netRevenueResources, $premiumResources);

        return [
            ID::make()->sortable(),

            Text::make('Type')
                ->sortable()
                ->rules('required', 'max:255'),

            Select::make('Contract Type Definition', 'contract_type_definition')
                ->options($resources)
                ->displayUsingLabels(),

            Boolean::make('Show Referrals List','show_referrals_list'),

            HasMany::make('Partner Profiles','partnerProfiles'),

            HasMany::make('Contract Type Metrics','contractTypeMetrics'),
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
}
