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
            <div class="col-12">
                <h2>Enter your SSN (Last four digits)</h2>
                {{Form::model($autoRefinanceApplication, ['route' => ['auto_refinance-save_ssn_info', $autoRefinanceApplication->id]])}}

                <div class="form-group">
                    <label for="ssn">Last 4 digits of your SSN</label>
                    {{Form::text('ssn',$autoRefinanceApplication->ssn ,['class' => 'form-control','placeholder' => 'Last 4 digits of your SSN','id' => 'ssn'])}}
                    @if ($errors->has('ssn'))
                        <span class="text-danger">
                    {{ $errors->first('ssn') }}
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
