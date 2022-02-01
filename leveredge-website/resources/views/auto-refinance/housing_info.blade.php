@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@section('content')
    @include('landing-pages.partials._need-help-banner')
<div class="py-3"></div>
<div class="container narrow">
    @include('landing-pages.partials._step-timeline', [
        'steps' => $totalSteps ?? 0,
        'active' => $currentStep ?? 0,
    ])

    <div class="row justify-content-center">
        <div class="col-12 px-lg-5">
            <h2 class="text-center">Housing Information</h2>
            <p class="text-center">This information helps us prioritize deals that you'll qualify for</p>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-12">
            {{Form::model($autoRefinanceApplication, ['route' => ['auto_refinance-save_housing_info', $autoRefinanceApplication->id]])}}

            <div class="form-group">
                <label for="last_name">Street Address</label>
                {{Form::text('street_address',$autoRefinanceApplication->street_address ,['class' => 'form-control','placeholder' => 'Street Address','id' => 'street_address',])}}
                @if ($errors->has('street_address'))
                    <span class="text-danger">
                        {{ $errors->first('street_address') }}
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="street_address_2">Apartment/Suite #</label>
                        {{Form::text('street_address_2',$autoRefinanceApplication->street_address_2 ,['class' => 'form-control','placeholder' => 'Apartment/Suite #','id' => 'street_address_2'])}}
                        @if ($errors->has('street_address_2'))
                            <span class="text-danger">
                                {{ $errors->first('street_address_2') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="city">City</label>
                        {{Form::text('city',$autoRefinanceApplication->city ,['class' => 'form-control','placeholder' => 'City','id' => 'city'])}}
                        @if ($errors->has('city'))
                            <span class="text-danger">
                                {{ $errors->first('city') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="state">State</label>
                        {{Form::select('state',$states,$autoRefinanceApplication->state ,['class' => 'form-control','placeholder' => 'State','id' => 'state'])}}
                        @if ($errors->has('state'))
                            <span class="text-danger">
                        {{ $errors->first('state') }}
                    </span>
                        @endif
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="zip_code">Zip Code</label>
                        {{Form::text('zip_code',$autoRefinanceApplication->zip_code ,['class' => 'form-control','placeholder' => 'Zip Code','id' => 'zip_code'])}}
                        @if ($errors->has('zip_code'))
                            <span class="text-danger">
                        {{ $errors->first('zip_code') }}
                    </span>
                        @endif
                    </div>
                </div>
            </div>



            <div class="form-group">
                <label for="stay_duration">How long have you stayed there?</label>
                {{Form::select('stay_duration',$years_at_address,$autoRefinanceApplication->stay_duration ,['class' => 'form-control','placeholder' => 'How long have you stayed there?','id' => 'stay_duration'])}}
                @if ($errors->has('stay_duration'))
                    <span class="text-danger">
                        {{ $errors->first('stay_duration') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="residence_ownership">Do you rent or own?</label>
                {{Form::select('residence_ownership', [
                    'Family member owned' => 'Family member owned',
                    'Self-Owned' => 'Self-Owned',
                    'Rent' => 'Rent'
                    ],$autoRefinanceApplication->residence_ownership, ['class' => 'form-control','placeholder' => 'Residence Ownership','id' => 'residence_ownership'])}}
                @if ($errors->has('residence_ownership'))
                    <span class="text-danger">
                        {{ $errors->first('residence_ownership') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="housing_payment">Housing Payment (Rent / Mortgage)</label>
                {{Form::text('housing_payment',$autoRefinanceApplication->housing_payment, ['class' => 'form-control','placeholder' => 'Housing Payment','id' => 'housing_payment'])}}
                @if ($errors->has('housing_payment'))
                    <span class="text-danger">
                        {{ $errors->first('housing_payment') }}
                    </span>
                @endif
            </div>



            <button type="submit" class="btn btn-primary">Next</button>

            {{ Form::close() }}

        </div>
    </div>
</div>
<div class="py-3"></div>
@endsection




