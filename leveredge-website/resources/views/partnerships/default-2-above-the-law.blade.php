@extends('template.public')


@section('content')

    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-brand text-light border-radius-0 animated slideInDown" style="animation-delay: 1s;">
        <div class="container pb-2 pt-2">
            <div class="row">
                <div class="col-12 text-center">
                    Welcome Above The Law Readers!
                    {{--<strong>{{ \Carbon\Carbon::create(2019,6,1)->diffInDays() }} Days Left</strong> to Join the  Negotiation Group For Students Needing Loans in Fall 2019--}}
                </div>
            </div>
        </div>
    </div>

    <div id="in-school-landing-page">

        <div class="jumbotron bg-white mt-0 mb-0 pt-0 pb-0" id="modern-hero">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h1>Need help with student loans?</h1>
                        <h2>We use group buying power to negotiate down your loan rates</h2>

                        <div class="">
                            <p class="tips">
                                <img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">
                                Free for students
                            </p>

                            <p class="tips">
                                <img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">
                                No obligation to take the deal we negotiate
                            </p>
                        </div>
                    </div>

                    <div class="col-12 offset-md-1 col-md-5 mt-5 mt-md-0">
                        <img src="{{ '/img/join_pages/law.jpg' }}" class="img-fluid">

                    </div>
                </div>

                <div class="row" style="margin-top: 15px">

                    {{--<div class="d-none d-md-flex col-md-3" style="flex-direction: column; justify-content: center;">--}}
                        {{--<p class="tips" style="font-size: 24px; text-transform: none; color: #3b61e3;">--}}
                        {{--<img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">--}}
                        {{--Free for students--}}
                        {{--</p>--}}

                        {{--<p class="tips mt-5" style="font-size: 24px; text-transform: none; color: #3b61e3;">--}}
                        {{--<img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">--}}
                        {{--No obligation to take the deal we negotiate--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    <div class="col-12 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                @include('common.general-law-sign-up-form')
                            </div>
                        </div>
                    </div>

                    <div class="d-none offset-md-1 d-md-flex col-md-3" style="flex-direction: column; justify-content: center; align-items: center">
                        <p class="mt-5">As Featured In:</p>
                        @include('in-school.landing-page.law-vertical-press')
                    </div>

                </div>
            </div>
        </div>

        <div class="d-md-none">
            <div class="container pt-0 pb-0 mt-0 mb-0">
                <div class="row">
                    <div class="col-12 d-flex" style="flex-direction: column; justify-content: center; align-items: center">
                        <p>As Featured In:</p>
                        @include('in-school.landing-page.law-vertical-press')
                    </div>
                </div>
            </div>
        </div>

        <hr>

        {{--<div class="jumbotron bg-white mt-0 mb-0 pt-0 pb-0" id="modern-hero">--}}
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-12 text-center">--}}
                        {{--<h1>NEED A LOAN FOR MEDICAL SCHOOL?</h1>--}}
                        {{--<h2>We use group buying power to negotiate down your loan rates</h2>--}}

                        {{--<p class="tips">--}}
                            {{--<img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">--}}
                            {{--Free for students.--}}
                        {{--</p>--}}

                        {{--<p class="tips">--}}
                            {{--<img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">--}}
                            {{--Less than 1 minute to join.--}}
                        {{--</p>--}}

                        {{--<p class="tips">--}}
                            {{--<img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">--}}
                            {{--No obligation to take the deal we negotiate.--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="row mt-4">--}}
                    {{--<div class="col-12 col-md-6 offset-md-3">--}}
                        {{--<div class="card">--}}
                            {{--<div class="card-body">--}}
                                {{--@include('in-school.form.form-1')--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="row mt-5">--}}
                    {{--<div class="col-12 text-center">--}}
                        {{--<a href="#how-it-works">--}}
                            {{--<img style="max-height: 50px;" src="{{ url('img/down-arrow.png') }}" class="mx-auto">--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}


        <div class="jumbotron bg-transparent pt-0 pb-0 mt-0 mb-0">
            @include('common.products-law')
        </div>

        <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-light-grey">
            @include('common.how-it-works')
        </div>

        <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h2>Our Track Record</h2>
                        <div class="separator"></div>
                        <p class="mt--3">Last Fall, the Juno team helped 400+ students get loans totaling over $25M at low interest rates. Students saved more than $3.3M compared to federal options.</p>

                        <p class="mt-3">The average student saved $8,334 compared to the federal grad plus loan option.</p>

                        <p class="mt-3 text-capitalize">
                            <a class="link" href="{{ url('/our-track-record') }}">Learn more about this story</a>
                        </p>

                    </div>
                    <div class="col-12 col-md-6 justify-content-center align-self-center text-center mt-5 mt-md-0">
                        <img src="{{ url('/img/counter-savings.png') }}" class="img-fluid" style="max-height: 95px;">
                    </div>
                </div>
            </div>
        </div>


        <div class="jumbotron bg-light-grey pt-0 pb-0 mb-0 mt-0">
            @include('common.testimonials')
        </div>

    </div>
@endsection

<!-- Legal Disclaimers -->
@section('legal-disclosures')
    <p>There is no guarantee that a larger group will result in (additional) savings.</p>
    <p>We cannot guarantee that the rates and terms that are offered to you as part of a negotiation group are actually better than other options available to you.</p>
    <p>We cannot guarantee the accuracy of our calculators.</p>
    <p>All dates shown are preliminary and subject to change without notice.</p>
@endsection
