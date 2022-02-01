@extends('template.public')

@section('content')
    <div class="jumbotron bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col text-center">
                    <h1>Looking for a student loan deal?</h1>

                    <h3 class="mt-5">
                        Our most recent student loan deal just ended, but don't worry!
                    </h3>
                    <h3>
                        We're negotiating a new one right now.
                    </h3>
                </div>
            </div>

            @auth
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <h4 class="mt-5">
                            You are already a Juno Member.
                        </h4>
                        <h4>
                            We'll send you bi-weekly updated on the status of the negotiations.
                        </h4>
                        <h4>
                            Just make sure your profile is up to date so we know what to update you about.
                        </h4>

                        <a href="{{ route('user-profile.loan-type') }}" class="btn btn-secondary mt-5">
                            Update Profile
                        </a>
                        <a href="{{ url('/home') }}" class="btn btn-primary mt-5">
                            Visit Dashboard
                        </a>
                    </div>
                </div>
            @endauth

            @guest
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <h4 class="mt-5">Sign up here and we'll include you in bi-weekly updates on the status of the negotiations</h4>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 text-center">
                        @include('common.get-started-with-email-form')
                    </div>
                </div>
            @endguest

        </div>
    </div>


    @include('member.partials.general-group-20-21-partials.negotiation-timeline')
    <div class="my-5 py-5"></div>

@endsection

@push('header-scripts')
    <link href="{{mix('mix/css/pages/expired-deal.css')}}" rel="stylesheet" type="text/css">
@endpush
