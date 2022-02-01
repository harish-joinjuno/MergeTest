@extends('template.public')


@section('content')


    <div class="modal" tabindex="-1" role="dialog" id="late-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deal Launch Delayed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Hi there,</p>

                    <p class="mt-3">
                        Earnest is offering, for the first time ever, a rate reduction of 0.25% beyond their already low rates. This offer is exclusive to Juno Members.
                    </p>

                    <p class="mt-3">
                        Unfortunately, their engineering team needs until July 12th to make this deal available to you.
                    </p>

                    <p class="mt-3">
                        If you are already signed up, you will receive an email on July 12th with information on how to access the deal. If you haven't signed up yet, lucky you. You can still sign up.
                    </p>

                    <p class="mt-3">
                        Thank you for waiting!
                    </p>

                    <p>
                        Nikhil
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('footer-scripts')
    <script>
        $(window).on('load',function(){
            $('#late-modal').modal('show');
        });
    </script>
    @endpush


    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-brand text-light border-radius-0 animated slideInDown" style="animation-delay: 1s;">
        <div class="container pb-2 pt-2">
            <div class="row">
                <div class="col-12 text-center">
                    <strong>Negotiations are complete.</strong> Deal will be live on July 12th. Join before the group is closed.
                </div>
            </div>
        </div>
    </div>

    <div id="refi-landing-page">

        @if(isset($school))
            <div class="alert alert-success alert-dismissible fade show m-0" style="border-radius: 0" role="alert">
                 {!! $school->refinance_introduction_html !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="jumbotron bg-white mt-0 mb-0 pt-0 pb-0" id="modern-hero">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>LOOKING TO REFINANCE YOUR STUDENT LOANS?</h1>
                        <h2>We use group buying power to negotiate down your loan rates</h2>

                        <p class="tips">
                            <img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">
                            No fees for students.
                        </p>

                        {{--<p class="tips">--}}
                            {{--<img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">--}}
                            {{--Less than 1 minute to join.--}}
                        {{--</p>--}}

                        <p class="tips">
                            <img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">
                            No obligation to take the deal we negotiate.
                        </p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-body">
                                @include('refinance.form.form-1')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- How It Works -->
        <div class="jumbotron bg-white pb-0 pt-0 mb-0 mt-0">
            @include('common.refi-how-it-works')
        </div>

        <!-- Current Progress -->
        {{--<div class="jumbotron bg-white pb-0 pt-0 mb-0 mt-0">--}}
            {{--@include('common.refi-current-progress')--}}
        {{--</div>--}}

        <!-- Testimonials -->
        <div class="jumbotron pb-0 pt-0 bg-light-grey mt-0 mb-0">
        @include('common.testimonials')
        </div>

        <!-- The Juno Commitment -->
        <div class="jumbotron pb-0 pt-0 bg-transparent mt-0 mb-0">
            @include('common.commitment')
        </div>

        <!-- Common Questions -->
        <div class="jumbotron pb-0 pt-0 bg-light-grey mt-0 mb-0">
            @include('common.refi-common-questions')
        </div>

    </div>
@endsection

@section('legal-disclosures')
    <p>There is no guarantee that a larger group will result in (additional) savings.</p>
    <p>We cannot guarantee that the rates and terms that are offered to you as part of a negotiation group are actually better than other options available to you.</p>
    <p>We cannot guarantee the accuracy of our calculators.</p>
    <p>All dates shown are preliminary and subject to change without notice.</p>
@endsection
