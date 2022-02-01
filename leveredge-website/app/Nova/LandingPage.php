<?php

namespace App\Nova;

use App\Support\StoreLandingPageAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Symfony\Component\Finder\Finder;

class LandingPage extends Resource
{
    public static $model = \App\LandingPage::class;

    public static $title = 'id';

    public static $group = 'Partner Management';

    public static $search = [
        'id', 'name', 'slug',
    ];

    public function fields(Request $request)
    {
        $logos                    = [];
        $partnershipsLogoPath     = 'img/partnership/';
        $partnershipLogoDirectory = public_path($partnershipsLogoPath);
        $logoFiles                = (new Finder)->files()->in($partnershipLogoDirectory);
        foreach ($logoFiles as $logoFile) {
            $logoName                                                = explode('.', $logoFile->getFilename())[0];
            $logos[$partnershipsLogoPath . $logoFile->getFilename()] =  $logoName;
        }
        $defaultFields = [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Slug')
                ->rules('required', 'max:255')
                ->creationRules('unique:landing_pages,slug')
                ->updateRules('unique:landing_pages,slug,{{resourceId}}'),

            File::make('Logo')->store(new StoreLandingPageAttachment)->required(),

            Text::make('Partner Page Url', 'partner_referral_url')
                ->readonly()
                ->hideFromIndex(),

            Boolean::make('Hide Medical', 'hide_medical')->nullable(),

            Text::make('Non Medical Section Title', 'non_medical_section_title')->nullable(),

            BelongsTo::make('Partner Profile', 'partner_profile', Partner::class)
                ->searchable()
                ->sortable(),

            BelongsTo::make('Template', 'template', LandingPageTemplate::class),
        ];
        $properties = $this->resource->properties;
        if ($this->resource->template && $this->resource->template->required_properties) {
            foreach ($this->resource->template->required_properties as $property) {
                $defaultFields[] = Trix::make(Str::title($property), '_' . $property)
                    ->hideFromIndex()
                    ->required()
                    ->withMeta([
                        'value' => $properties ? $properties->$property : null,
                    ]);
            }
        }

        return $defaultFields;
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
