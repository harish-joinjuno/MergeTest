@extends('template.public')

@section('content')


    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-uppercase d-none d-md-block">Don't Leave Your Friends Behind</h5>
                    <h1 class="mt-3 brand-color text-uppercase" style="font-size: 34px; letter-spacing: 1.5px;">
                        <strong>
                            Invite Friends<span class="d-none d-md-inline"> &</span> Earn Rewards
                        </strong>
                    </h1>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <p>
                        For each friend who takes either the student loan deal or the refinance deal, you get $25, they get $25.
                    </p>
                    <p class="mt-3 mt-lg-0">
                        In addition, you can unlock additional prizes for student loan referrals:
                    </p>
                </div>

                <div class="col-12 mt-3">
                    <img src="{{ url('/img/referral-prizes/referrals-prizes-summary.png') }}" class="img-fluid mt-2 d-none d-lg-inline negotiated-deal-shadow">
                    <img src="{{ url('/img/referral-prizes/referrals-prizes-summary-vertical.png') }}" class="img-fluid mt-2 img-thumbnail d-lg-none">
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 col-lg-6">
                    <div class="card negotiated-deal-shadow border-0">
                        <div class="card-body">
                            <h3>
                                Existing Member
                            </h3>
                            <a class="btn btn-primary mt-5" href="{{ route('login') }}">Login to view your Dashboard</a>
{{--                            <p class="mt-3">--}}
{{--                                Track your progress and get your unique sharing link.--}}
{{--                            </p>--}}
{{--                            @include('affiliate.existing-referral-member-form')--}}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                    <div class="card negotiated-deal-shadow border-0">
                        <div class="card-body">
                            <h3>
                                New Member
                            </h3>
                            <p class="mt-3">
                                We’ll send you a personal referral link to share. You don’t have to take the deal yourself to earn rewards! Share with anyone interested in saving money on their student loans.
                            </p>
                            @include('affiliate.new-referral-member-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <hr class="mt-0 mb-0 pt-0 pb-0">

    @include('affiliate.referral-terms-and-conditions')


@endsection
