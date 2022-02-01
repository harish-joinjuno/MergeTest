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
                <h2 class="text-center">Loan and Vehicle Information</h2>
                <p class="text-center">This information helps ensure we are negotiating a deal that's better than the loan you already have</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2>Payment Info</h2>
                {{Form::model($autoRefinanceApplication, ['route' => ['auto_refinance-save_payment_info', $autoRefinanceApplication->id]])}}

                <div class="form-group">
                    <label for="payoff_amount">Payoff Amount (Optional)
                        <i
                            class="fas fa-question-circle"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="How much you will have to pay to satisfy the terms of your loan and completely pay off
                            your debt."
                        ></i>
                    </label>
                    {{Form::text('payoff_amount',$autoRefinanceApplication->payoff_amount ,['class' => 'form-control','placeholder' => 'Payoff Amount','id' => 'payoff_amount'])}}
                    @if ($errors->has('payoff_amount'))
                        <span class="text-danger">
                        {{ $errors->first('payoff_amount') }}
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="monthly_payment">Monthly Payment (Optional)</label>
                    {{Form::text('monthly_payment',$autoRefinanceApplication->monthly_payment ,['class' => 'form-control','placeholder' => 'Monthly Payment','id' => 'monthly_payment'])}}
                    @if ($errors->has('monthly_payment'))
                        <span class="text-danger">
                            {{ $errors->first('monthly_payment') }}
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="mileage">Mileage (Estimated)</label>
                    {{Form::text('mileage',$autoRefinanceApplication->mileage ,['class' => 'form-control','placeholder' => 'Mileage','id' => 'mileage'])}}
                    @if ($errors->has('mileage'))
                        <span class="text-danger">
                            {{ $errors->first('mileage') }}
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




