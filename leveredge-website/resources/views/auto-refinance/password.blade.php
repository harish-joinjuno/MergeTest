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
        <div class="col-12 col-lg-8">
            <h2 class="text-center">Password</h2>
            <p class="text-center">For security purposes, we ask that you create a strong password that is at least 6 characters.</p>

            <form action="{{route('auto_refinance-save_password')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    @if ($errors->has('password'))
                        <span class="text-danger">
                    {{ $errors->first('password') }}
                    </span>
                    @endif

                    @if ($errors->has('email'))
                    <span class="text-danger">
                        {{ $errors->first('email') }}
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="py-3"></div>
@endsection




