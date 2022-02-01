@extends('template.public')

@section('content')

    <div id="refi-landing-page">


        @if(isset($school))

            {{--<div class="container mt-0 mb-0 pt-0 pb-0">--}}
                {{--<div class="row mt-0 mb-0 pt-0 pb-0">--}}

            <div class="alert alert-success alert-dismissible fade show m-0" style="border-radius: 0" role="alert">
                 {!! $school->refinance_introduction_html !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                {{--</div>--}}
            {{--</div>--}}




            {{--<div class="jumbotron bg-gradient m-0 p-0">--}}
                {{--<div class="container p-3">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-12">--}}
                            {{--<h1 class="p-0 m-0">Welcome Darden Students</h1>--}}
                            {{--<p class="p-0 m-0">--}}
                                {{--The Darden Student Organization is helping you to join forces with other students around the country to negotiate down your refinance loan rates via Juno! Juno is able to offer these services at no cost thanks to their help.--}}
                            {{--</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        @endif

        <div class="jumbotron m-0" id="hero-with-picture">
            <div class="container mb-0">
                <div class="row">
                    <div class="col-12 d-md-none mb-4">
                        <h3>Looking to refinance your student loans?</h3>
                        <img src="{{ url('/img/banks-compete.png') }}" class="img-fluid">
                    </div>
                    <div class="col-12 col-md-7">
                        <h3 class="d-none d-md-block">Looking to refinance your student loans?</h3>
                        {{--<h1>Join forces with students around the country to negotiate down your interest rates.</h1>--}}
                        <h1>We use group buying power to negotiate down your loan rates</h1>

                        <form class="form" action="{{ url('join/refi') }}" method="post">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="label-text" for="name">Name</label>
                                    <input autofocus type="text" name="name" class="form-control mb-2 mr-sm-2{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="e.g. John" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="label-text" for="email">Email</label>
                                    <input name="email" type="email" class="form-control mb-2 mr-sm-2{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="e.g. john@gmail.com" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="label-text" for="type">Type</label>
                                    <select id="type" class="mb-2 mr-sm-2 form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                        <option @if( old('type') == "Domestic Student" ) selected @endif value="Domestic Student">Domestic Student</option>
                                        <option @if( old('type') == "International Student" ) selected @endif value="International Student">International Student</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>


                            </div>

                            <button type="submit" value="submit" class="btn btn-primary">Sign Up Now</button>
                            <a href="#how-it-works" class="btn btn-link text-uppercase mt-3">Learn More</a>
                        </form>

                        <h2 class="mt-4" style="color: #6b6774; font-size: 1rem">
                            <div>
                                <i class="far fa-check-circle"></i> No fees for students
                            </div>
                            <div class="mt-2">
                                <i class="far fa-check-circle"></i> No obligation to take the loan we negotiate
                            </div>

                        </h2>

                    </div>
                    <div class="d-none d-md-block col-md-5 justify-content-center align-self-center">
                        <img src="{{ url('/img/banks-compete.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>


        {{--<div class="jumbotron mb-0" id="hero">--}}
            {{--<div class="container" id="hero-container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--@if( isset($school) )<p class="text-grey m-0">Trusted By {{$school}} Students</p>@endif--}}
                        {{--<h3 class="text-white">Have student loan debt?</h3>--}}
                        {{--<h3 class="text-white">Looking to refinance your student loans?</h3>--}}
                        {{--<h1>Juno gets banks competing for your business at no cost to you.</h1>--}}
                        {{--<h2>--}}
                            {{--<i class="fa fa-minus mr-3"></i> --}}
                            {{--There are no fees or costs. <br>Juno is <span class="text-underline">completely free</span> for you.</h2>--}}
                            {{--There are no fees or costs. <br>Juno is <span class="text-underline">completely free</span> for you.</h2>--}}
                            {{--<a href="{{url('/join/refi/form-1')}}" class="btn btn-primary btn-lg">Sign Up Now</a>--}}
                            {{--<a href="#how-it-works" class="btn btn-link text-uppercase mt-3">Learn More</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="jumbotron mb-0" id="hero">--}}
            {{--<div class="container" id="hero-container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--@if( isset($school) )Trusted By <img src="{{url( '/img/clients/' . $school . '.png' )}}" height="100px">@endif--}}
                        {{--<h1>Negotiate your Refi Rate as a Group</h1>--}}
                        {{--<h2>Juno gets students lower rates than they could ever get on their own.</h2>--}}
                        {{--<a href="{{url('/join/refi/form-1')}}" class="btn btn-primary btn-lg">Join the Group</a>--}}
                        {{--<a href="#how-it-works" class="btn btn-link text-uppercase">Learn More</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <!-- Clients Banner -->
        @include('common.clients-banner')

        <!-- How It Works -->
        <div class="jumbotron bg-transparent pb-0 pt-0 mb-0 mt-0">
        {{--@include('common.refi-how-it-works',[--}}
            {{--'call_to_action_text' => 'Join Now',--}}
            {{--'call_to_action_link' => url('/join/refi/form-1')--}}
        {{--])--}}

            @include('common.refi-how-it-works')
        </div>

        <!-- Call to Action Section -->
    @include('common.call-to-action',[
        'cta_url' => url('/join/refi/form-1'),
        'cta_text' => 'Joining takes less than 2 minutes and could save you thousands on your student loan.',
        'cta_button_text' => 'Join Now'
    ])

        <!-- How Much Will I Save -->
        {{--<div class="jumbotron pb-0 pt-0 bg-cream mt-0 mb-0">--}}
            {{--@include('common.estimated-savings',[--}}
            {{--'call_to_action_text' => 'Start Saving',--}}
            {{--'call_to_action_link' => url('/join/refi/form-1')--}}
        {{--])--}}
        {{--</div>--}}

        <!-- Testimonials -->
        <div class="jumbotron pb-0 pt-0 bg-transparent mt-0 mb-0">
        @include('common.testimonials')
        </div>

        <!-- The Juno Commitment -->
        <div class="jumbotron pb-0 pt-0 bg-transparent mt-0 mb-0">
            @include('common.commitment')
        </div>


        @include('common.call-to-action',[
            'cta_url' => url('/join/refi/form-1'),
            'cta_text' => 'The larger the group, the more leverage we have to get you a better deal.',
            'cta_button_text' => 'Join Now'
        ])

        {{--<!-- Refi Rates -->--}}
        {{--<div class="jumbotron pb-0 pt-0 bg-transparent mb-0 mt-0">--}}
        {{--@include('common.refi-rates',[--}}
            {{--'call_to_action_text' => 'Join the Group',--}}
            {{--'call_to_action_link' => url('/join/refi/form-1')--}}
        {{--])--}}
        {{--</div>--}}

        <!-- Common Questions -->
        <div class="jumbotron pb-0 pt-0 bg-transparent mt-0 mb-0">
            @include('common.refi-common-questions')
        </div>

        <!-- Refi Lenders -->
        <div class="jumbotron pb-0 pt-0 bg-transparent mt-0 mb-0">
        @include('common.refi-lenders')
        </div>

        <!-- Call to Action Section -->
    @include('common.call-to-action',[
        'cta_url' => url('/join/refi/form-1'),
        'cta_text' => 'No fees for students + No commitment to take the negotiated loan = No-brainer',
        'cta_button_text' => 'Join Now'
    ])

        <!-- Contact Us -->
        <div class="jumbotron pb-0 pt-0 bg-transparent mb-0 mt-0">
            @include('common.contact-us')
        </div>

    </div>
@endsection

@section('legal-disclosures')
    <p>There is no guarantee that a larger group will result in (additional) savings.</p>
    <p>We cannot guarantee that the rates and terms that are offered to you as part of a negotiation group are actually better than other options available to you.</p>
    <p>We cannot guarantee the accuracy of our calculators.</p>
    <p>All dates shown are preliminary and subject to change without notice.</p>
    <p>1 - For each negotiation, we may or may not reach out to each of the lenders listed. We may also reach out to additional lenders beyond those listed here.</p>
    {{--<p>2 - 5 year rates assumed accessible based on information available at https://studentloanhero.com/featured/5-banks-to-refinance-your-student-loans/ on 11/20/2018 at 9:04PM.</p>--}}
@endsection
