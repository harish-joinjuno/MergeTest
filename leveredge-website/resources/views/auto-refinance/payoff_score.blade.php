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
        <div class="row justify-content-center mb-5">
            <div class="col-12 px-lg-5">
                <h2 class="text-center">Loan Information</h2>
                <p class="text-center">This information helps ensure we are negotiating a deal that's better than the loan you already have</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                {{
                    Form::model(
                        $autoRefinanceApplication,
                        ['route' => ['auto_refinance-save_payment_info', $autoRefinanceApplication->id]]
                    )
                }}

                @include('auto-refinance.fields.payoff')
                @include('auto-refinance.fields.credit_score')

                <button type="submit" class="btn btn-primary">Next</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="py-3"></div>
@endsection
