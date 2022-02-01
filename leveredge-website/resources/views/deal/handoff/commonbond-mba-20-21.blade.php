@extends('template.public')

@push('header-scripts')
    <style>
        h1{
            font-size: 32px;
        }
    </style>
@endpush

@section('content')
<div class="py-3 py-lg-5"></div>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="off-black">The next step is with CommonBond.</h1>
        </div>
    </div>
</div>


<div class="jumbotron bg-translucent-green py-3 my-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-5 text-center">
                <h4 class="fw-600">Remember: you have alternatives</h4>
                <p>
                    If you don't love the rates you get from CommonBond, come back! We have other options for you to consider.
                </p>
            </div>

            <div class="col-12 offset-lg-1 col-lg-5 text-center mt-3 mt-lg-0">
                <h4 class="fw-600">We're still here for you!</h4>
                <p>
                    Seriously, if you run into any hiccups along the way, or want to chat about your options, email us at <a href="mailto:support@joinjuno.com">support@joinjuno.com</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <a href="{{ $url }}" class="btn btn-primary btn-lg">Continue to CommonBond</a>
        </div>
    </div>
</div>

    <div class="py-5"></div>

@endsection
