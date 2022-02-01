<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use NovaItemsField\Items;
use Symfony\Component\Finder\Finder;

class LandingPageTemplate extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\LandingPageTemplate::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static $group = 'Partner Management';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $templates                       = [];
        $landingPagesTemplates           = 'views/landing-pages/partnerships/';
        $partnershipLandingPageDirectory = resource_path($landingPagesTemplates);
        $templateFiles                   = (new Finder)->files()->in($partnershipLandingPageDirectory);
        foreach ($templateFiles as $templateFile) {
            $fileName = explode('.', $templateFile->getFilename())[0];

            if (! Str::startsWith($fileName, '_')) {
                $templateName             = Str::title(str_replace('-', ' ', $fileName));
                $templates[$templateName] = $templateName;
            }
        }

        return [
            ID::make()->sortable(),

            Select::make('Name', 'name')
                ->options($templates)
                ->displayUsingLabels()
                ->required(),

            Text::make('Slug', 'slug')
                ->readonly(),

            Items::make('Required Properties', 'required_properties')
                ->hideWhenCreating()
                ->fullWidth()
                ->nullable(),

            BelongsToMany::make('Rates', 'rates')->nullable(),

            BelongsToMany::make('Alt Rates', 'altRates', Rate::class)->nullable(),

            BelongsToMany::make('Faq Groups', 'faqGroups')->nullable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
