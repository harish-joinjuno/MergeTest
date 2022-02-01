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

    <div class="row">
        <div class="col-12 px-lg-5">
            <h2 class="text-center">Employment Information</h2>
            <p class="text-center">This information helps us prioritize deals that you are likely to qualify for</p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            {{Form::model($autoRefinanceApplication, ['route' => ['auto_refinance-save_employment_info', $autoRefinanceApplication->id]])}}

            <div class="row">
                <div class="col-6">

                    <div class="form-group">
                        @if (getClient()->isPartOfExperiment(App\Experiment::find(App\Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS)))
                            <label for="zip_code">Zip Code</label>
                            {{Form::text('zip_code',$autoRefinanceApplication->zip_code,[ 'class' => 'form-control', 'placeholder' => 'Zip Code','id' => 'zip_code'])}}
                            @if ($errors->has('zip_code'))
                                <span class="text-danger">
                                    {{ $errors->first('zip_code') }}
                                </span>
                            @endif
                        @else
                            <label for="employment_status">Employment Status</label>
                            {{Form::select('employment_status', [
                                'Full time' => 'Full time',
                                'Part time' => 'Part time',
                                'Retired' => 'Retired',
                                'Student' => 'Student',
                                'Active Duty Military' => 'Active Duty Military',
                                'Unemployed' => 'Unemployed',
                                'Other' => 'Other',
                                ],$autoRefinanceApplication->employment_status, ['class' => 'form-control','placeholder' => 'Employment Status','id' => 'employment_status'])}}
                            @if ($errors->has('employment_status'))
                                <span class="text-danger">
                                    {{ $errors->first('employment_status') }}
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="yearly_pre_tax_income">Annual Income (Pre-Tax)</label>
                        {{Form::text('yearly_pre_tax_income',$autoRefinanceApplication->yearly_pre_tax_income ,['class' => 'form-control','placeholder' => 'Annual Income (Pre-Tax)','id' => 'yearly_pre_tax_income'])}}
                        @if ($errors->has('yearly_pre_tax_income'))
                            <span class="text-danger">
                                {{ $errors->first('yearly_pre_tax_income') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            @if (!getClient()->isPartOfExperiment(App\Experiment::find(App\Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS)))
            <div class="form-group">
                <label for="work_duration">How long have you worked here?</label>
                {{Form::select('work_duration',$yearsWorkedOptions,$autoRefinanceApplication->work_duration ,['class' => 'form-control','placeholder' => 'How long have you worked here?','id' => 'work_duration'])}}
                @if ($errors->has('work_duration'))
                    <span class="text-danger">
                    {{ $errors->first('work_duration') }}
                </span>
                @endif
            </div>
            @endif

            <div class="form-group">
                <label for="credit_score">Credit Score</label>
                {{Form::select('credit_score',$creditScores,$autoRefinanceApplication->credit_score ,['class' => 'form-control','placeholder' => 'What is your approximate credit score?','id' => 'credit_score'])}}
                @if ($errors->has('credit_score'))
                    <span class="text-danger">
                        {{ $errors->first('credit_score') }}
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Next</button>

            {{Form::close()}}
        </div>
    </div>
</div>
<div class="py-3"></div>
@endsection




