@extends('template.public')

@php

$message = "Juno is an attempt by Harvard Business School students to reduce interest rates on student loans. They use group buying power to get lenders to compete and lower interest rates. Signing up is free and they only ask for your name and an email address. There's nothing to lose but if this becomes successful, you can save a lot on your loans. They did this last year and students saved $8,000 on average compared to the federal student loan options. Check it out here: https://joinjuno.com";

@endphp

@section('content')


    <div class="jumbotron mt-0 mb-0 pt-0 pb-5 bg-light-grey">
        <div class="container mb-0 pb-0">
            <div class="row mb-3">
                <div class="col-12 text-center">
                    <img src="{{ url('/img/thumbs-up.png') }}" class="img-fluid" style="max-height: 70px;">
                </div>
                <div class="col-12 text-center">
                    <h4 class="mt-4">
                        Thanks for voting.<br>
                        Sharing your preferences allow us to negotiate a better deal for you.
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron mt-0 mb-0 pt-0 pb-5 bg-transparent">
        @include('common.invite-content')
    </div>

@endsection
