@extends('template.public')

@push('header-scripts')

    <style>
        #welcome-hero h1{
            font-size: 40px;
            line-height: 48px;
            margin-bottom: 32px;
        }

        @media (min-width: 992px) {
            #welcome-hero h1{
                font-size: 58px;
                line-height: 64px;
            }
        }



        #welcome-hero h2{
            font-family: "GTWalsheimPro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 20px;
            color: #000000;
            margin-bottom: 32px;
        }

        @media (min-width: 992px) {
            #welcome-hero h2{
                font-size: 22px;
            }
        }



        #welcome-hero input, #welcome-hero button
        {
            height: 48px;
            border-radius: 48px;
            border-color: #ffffff;
        }

        #welcome-hero input{
            padding-left: 20px;
            padding-right: 130px;
            background-color: #F6FAF9;
        }

        #welcome-hero button{
            font-size: 15px;
            margin-left: -130px;
            width: 130px;
            z-index: 4;
        }


        @media (min-width: 992px) {

            #welcome-hero input, #welcome-hero button
            {
                height: 72px;
                border-radius: 72px;
            }

            #welcome-hero input{
                padding-left: 32px;
                padding-right: 160px;
            }

            #welcome-hero button{
                font-size: 18px;
                margin-left: -160px;
                width: 160px;
                z-index: 4;
            }

        }

        #welcome-hero input::placeholder,
        #welcome-hero input:-ms-input-placeholder,
        #welcome-hero input::-ms-input-placeholder,
        #welcome-hero input::-webkit-input-placeholder{
            color: #000000;
            opacity: 1;
        }




        #check-features{
            font-size: 16px;
            color: #222222;
        }

        #check-features i{
            font-size: 12px;
            margin-right: 8px;
            color: #398B86;
        }


        #press-section{
            background: linear-gradient(0deg,#EDF6F5,#EDF6F5),linear-gradient(180deg,#f3f4ed,#fff 50%);
            color: #6C7272;

            font-size: 14px;
            margin-top: -50px;
            padding-top: 50px;
        }

        #press-section a{
            font-weight: 500;
            color: #6C7272;
        }

        #press-section a:hover{
            text-decoration: none;
        }


        @media (min-width: 992px) {
            #press-section{
                font-size: 18px;
                margin-top: -190px;
                padding-top: 190px;
            }
        }

        @media (min-width: 992px) {
            .lamp-background{
                background-image: url('/img/how-it-works-auction-lamp.png');
                background-repeat: no-repeat;
                background-position: bottom right;
                background-size: contain;
            }
        }

        h3.large-description{
            font-family: "CooperMediumBT", serif;
            font-size: 28px;
            color: #488C89;
        }

        @media (min-width: 992px) {
            h3.large-description{
                font-size: 34px;
            }
        }


        #how-it-works-home .step-number{
            color: #849A99;
            font-size: 18px;
        }

        @media (min-width: 992px) {
            #how-it-works-home .step-number{
                font-size: 16px;
            }
        }

        .large-voila-button{
            height: 72px;
            border-radius: 72px;
            border-color: #ffffff;
            padding-left: 32px;
            padding-right: 32px;
        }


        @media (min-width: 992px) {
            .students-standing-around-background{
                background-image: url('/img/students-standing-around.png');
                background-repeat: no-repeat;
                background-position: 30% 50%;
                background-size: 300px;
            }
        }

        .p-features{
            padding-left: 60px;
            padding-right: 60px;
            height: 300px;
        }

        .h-300{
            height: 300px;
        }

        .peel-bottom{
            background-image: url('/img/peel.png');
            background-repeat: no-repeat;
            background-position: 100% 100%;
            background-size: contain;
        }

        .peel-large-bottom{
            height: 300px;
            background-image: url('/img/peel-large.png');
            background-repeat: no-repeat;
            background-position: 0% 100%;
            background-size: 60%;
        }

        .video-thumbnail-background{
            background-image: url('/img/video-thumbnail-matt.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .video-play-icon{
            font-size: 120px;
            color: green;
        }

        .h-250{
            height: 250px;
        }

        .students-walking-away-row{
            margin-top: -75px;
        }

        .split-bg-translucent-green-white{
            background: linear-gradient(0deg, #EDF6F5 50%, #FFFFFF 50%);
        }

        .split-bg-white-translucent-green{
            background: linear-gradient(180deg, #EDF6F5 50%, #FFFFFF 50%);
        }

        .free-for-students{
            border-bottom: 1px dashed #222222;
        }

        .product-card{
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding-left: 18px;
            padding-right: 18px;
        }

        .product-card img{
            height: 100px;
        }

        .product-card h2{
            font-size: 28px;
        }

        .product-card p{
            font-size: 1.1rem;
        }

        @media (min-width: 992px) {
            .product-card td{
                height: 56px;
                vertical-align: top;
            }
        }


    </style>


    <link rel="stylesheet" href="{{ url('/vendor/animate-on-scroll/aos.css') }}" />
    <link rel="stylesheet" href="{{ url('/vendor/fancybox/jquery.fancybox.min.css') }}">

@endpush

@push('footer-scripts')
    <script src="{{ url('/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
    <script src="{{ url('/vendor/animate-on-scroll/aos.js') }}"></script>
    <script>
        AOS.init({
            offset: 200,
            duration: 600,
            easing: 'ease-in-sine',
            delay: 100,
            once: true
        });
    </script>
@endpush

@section('content')

    <div class="jumbotron my-0 py-2 bg-primary rounded-0">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center text-white">
                    LeverEdge is now Juno! <u><a class="text-white fw-500" href="{{ url('leveredge-is-now-juno') }}" target="_blank">Learn Why</a></u>
                </div>
            </div>
        </div>
    </div>


    @yield('pre-content')

    <div class="jumbotron bg-white mb-0 pb-0" id="welcome-hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center">
                    <h1>
                        We use group buying power to negotiate better student loan rates.
                    </h1>
                    <h2>
                        Rates negotiated exclusively for members start at 1.24% APR<sup class="foot-note-marker">14</sup>
                    </h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <form class="form d-none d-md-block" action="{{ url('/register') }}" method="get">
                        @csrf
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" name="email" class="form-control" placeholder="Enter your email" aria-label="Enter your email" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Get Started</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form class="form d-md-none" action="{{ url('/register') }}" method="get">
                        @csrf
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Get Started</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="row text-center" id="check-features">
                <div class="col-12 d-md-flex justify-content-md-center">
                    <div class="mx-4">
                        <i class="fas fa-check"></i> Free for you - <span class="free-for-students" data-toggle="tooltip" title="We charge lenders a fee that is set at the beginning of the process. The only way for a lender to win the auction is to offer the lowest rates to our members.">How?</span>
                    </div>
                    <div class="mx-4">
                        <i class="fas fa-check"></i> It takes <1 minute to join
                    </div>
                    <div class="mx-4">
                        <i class="fas fa-check"></i> No credit check
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="{{ url('/img/welcome-hero.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light-green" style="padding:160px 0 80px;margin:-160px auto -100px;">
        @include('landing-pages.partials._press-banner')
    </div>

    <section class="product-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card product-card">
                        <div class="card-body">
                            <img src="{{ asset('/img/briefcase-on-circle.png') }}">
                            <h2 class="mt-4">Graduate Student Loan Deal</h2>
                            <table class="mt-3">
                                <tr>
                                    <td style="vertical-align: top;">
                                        <i class="fad fa-check text-secondary-green"></i>
                                    </td>
                                    <td class="pl-2">
                                        Variable rates from 1.04% APR<sup class="foot-note-marker">14</sup> + up to 1% Cash Back
                                    </td>
                                </tr>
                            </table>
                            <table class="mt-2">
                                <tr>
                                    <td style="vertical-align: top;">
                                        <i class="fad fa-check text-secondary-green"></i>
                                    </td>
                                    <td class="pl-2">
                                        Exclusive rates up to 4% lower for members
                                    </td>
                                </tr>
                            </table>
                            <p class="mb-0 mt-4"><a href="{{ url('/register') }}" class="btn py-3 btn-block btn-secondary pill-radius">Access the Deal</a></p>
                            <p class=""><a href="{{ url('loans/graduate') }}" class="btn btn-block btn-link">Learn More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                    <div class="card product-card">
                        <div class="card-body">
                            <img src="{{ asset('/img/textbooks-on-circle.png') }}">
                            <h2 class="mt-4">Undergraduate Student Loan Deal</h2>
                            <table class="mt-3">
                                <tr>
                                    <td style="vertical-align: top;">
                                        <i class="fad fa-check text-secondary-green"></i>
                                    </td>
                                    <td class="pl-2">
                                        Variable rates from 1.05% APR<sup class="foot-note-marker">14</sup>
                                    </td>
                                </tr>
                            </table>
                            <table class="mt-2">
                                <tr>
                                    <td style="vertical-align: top;">
                                        <i class="fad fa-check text-secondary-green"></i>
                                    </td>
                                    <td class="pl-2">
                                        Exclusive rate discount of 1% for members
                                    </td>
                                </tr>
                            </table>
                            <p class="mb-0 mt-4"><a href="{{ url('/register') }}" class="btn py-3 btn-block btn-secondary pill-radius">Access the Deal</a></p>
                            <p class=""><a href="{{ url('loans/undergraduate') }}" class="btn btn-block btn-link">Learn More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                    <div class="card product-card">
                        <div class="card-body">
                            <img src="{{ asset('/img/refinance-check-on-circle.png') }}">
                            <h2 class="mt-4">Student Loan Refinancing Deal</h2>
                            <table class="mt-3">
                                <tr>
                                    <td style="vertical-align: top;">
                                        <i class="fad fa-check text-secondary-green"></i>
                                    </td>
                                    <td class="pl-2">
                                        Variable rates from 1.89% APR<sup class="foot-note-marker">14</sup>
                                    </td>
                                </tr>
                            </table>
                            <table class="mt-2">
                                <tr>
                                    <td style="vertical-align: top;">
                                        <i class="fad fa-check text-secondary-green"></i>
                                    </td>
                                    <td class="pl-2">
                                        Up to $1,000 cash back for members
                                    </td>
                                </tr>
                            </table>
                            <p class="mb-0 mt-4"><a href="{{ url('/register') }}" class="btn py-3 btn-block btn-secondary pill-radius">Access the Deal</a></p>
                            <p class=""><a href="{{ url('/refinance-campaign') }}" class="btn btn-block btn-link">Learn More</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="py-4"></div>

    <div class="container text-center text-lg-left" id="how-it-works-home">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 lamp-background text-center text-lg-left">
                <h2 class="section-title">How It Works</h2>
            </div>

            <div class="col-12 col-md-5 col-lg-7 offset-md-1 text-center text-lg-left my-4 my-md-0">
                <h3 class="large-description">We gather large groups of students who need help paying for school and get lenders to compete for our business.</h3>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <img src="{{ url('/img/how-it-works-block-3.png') }}" class="img-fluid" data-aos="fade-up">
            </div>
        </div>

        <div class="row no-gutters">
            <div class="col-12 col-lg-4 mb-5 mb-lg-0">
                <div class="px-4">
                    <div class="step-number fw-500 mb-2">Step 1.</div>
                    <h3 class="large-description mb-4">You sign up.</h3>
                    <p>
                        Sign up for free and tell us a little bit about yourself and the type of student loan you need.
                        <a href="{{ url('/eligibility') }}">Am I eligible?</a>
                    </p>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-5 mb-lg-0">
                <div class="px-4">
                    <div class="step-number fw-500 mb-2">Step 2.</div>
                    <h3 class="large-description mb-4">We run a bid.</h3>
                    <p>
                        We run a bidding process between banks, credit unions, and other lenders. They compete for our collective business by offering exclusive discounts.
                    </p>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="px-4">
                    <div class="step-number fw-500 mb-2">Step 3.</div>
                    <h3 class="large-description mb-4">We compare.</h3>
                    <p>
                        We compare all offers, negotiate terms, and select the best options for the group. We share the negotiated deals with you and you can decide to use it or not. There’s no commitment.
                    </p>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ url('/register') }}">
                    <button class="btn btn-secondary large-voila-button">Get Started</button>
                </a>
            </div>
        </div>
    </div>

    <div class="py-5"></div>
    <div class="py-5"></div>

    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-12 col-md-4 bg-secondary-green p-features d-flex text-center text-md-left">
                <h3 class="large-description text-white align-self-center">Join a student loan negotiation group today</h3>
            </div>
            <div class="col-12 col-md-8 bg-gray-one p-features d-flex justify-content-center justify-content-md-end students-standing-around-background">
                <div class="align-self-center text-center">
                    <p class="mb-0">Members signed up so far</p>
                    <h3 class="large-description">{{ number_format(  round( \App\User::count() , -3 ) ) }}+</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4 bg-white p-5 h-300 peel-bottom d-flex justify-content-center">
                <div class="align-self-center text-center">
                    <h3 class="large-description mb-2">$250M+ in Loans</h3>
                    <p class="mb-0">secured at the best rates</p>
                </div>
            </div>
            <div class="col-12 col-md-8 bg-gray-one p-features video-thumbnail-background d-flex justify-content-center">
                <div class="align-self-center video-play-icon text-white">
                    <a
                        data-fancybox
                        class="text-white"
                        href="https://www.youtube.com/watch?v=dxg-wPZgu5M&t=1s"
                    >
                        <i class="fad fa-play-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-8 bg-secondary-green p-features d-flex justify-content-center">
                <div class="align-self-center text-center">
                    <h3 class="large-description text-white mb-2">$350M+ in Demand</h3>
                    <p class="mb-0 text-white">for current negotiation groups</p>
                </div>
            </div>
            <div class="col-12 col-md-4 bg-gray-one p-features text-center d-flex justify-content-center">
                <div class="align-self-center">
                    <h3 class="large-description mb-2">Join now!</h3>
                    <a href="{{ url('/register') }}">
                        <button class="btn btn-secondary large-voila-button">Get Started</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="row students-walking-away-row d-none d-md-block">
            <div class="col-3 offset-7">
                <img src="{{ url('img/students-walking-away.png') }}" class="h-250">
            </div>
        </div>

    </div>


    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-title">Why Juno</h2>
            </div>
        </div>
    </div>

    <div class="jumbotron split-bg-translucent-green-white my-0 py-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 col-md-4 col-lg-3">
                    <img src="{{ url('/img/hands-on-laptop.png') }}" class="img-fluid" data-aos="fade-up">
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron bg-translucent-green my-0 py-0">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-10 col-md-6">
                    <h3 class="large-description">
                        Free, Fast and Easy
                    </h3>
                    <p>
                        Signing up is free and takes less than 1 minute. We don’t run a credit check and don’t need your social security number.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron split-bg-white-translucent-green my-0 py-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 col-md-4 col-lg-3">
                    <img src="{{ url('/img/better-loans.png') }}" class="img-fluid" data-aos="fade-up">
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron bg-white my-0 py-0">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-10 col-md-6">
                    <h3 class="large-description">
                        Better Loans
                    </h3>
                    <p>
                        Months of research and the competitive process ensure that our members get the best rates in the
                        market and you’re always free to compare yourself!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron split-bg-translucent-green-white my-0 py-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 col-md-4 col-lg-3">
                    <img src="{{ url('/img/together.png') }}" class="img-fluid" data-aos="fade-up">
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron bg-translucent-green my-0 py-0">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-10 col-md-6">
                    <h3 class="large-description">
                        Together
                    </h3>
                    <p>
                        Invite those you care about and help the negotiation be successful. The larger the group,
                        the better our chances of success. You'll also get rewarded for helping the group succeed.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron split-bg-white-translucent-green my-0 py-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 col-md-4 col-lg-3">
                    <img src="{{ url('/img/transparent.png') }}" class="img-fluid" data-aos="fade-up">
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron bg-white my-0 py-0">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-10 col-md-6">
                    <h3 class="large-description">
                        Transparent
                    </h3>
                    <p>
                        We will keep you informed through the entire process so you can make informed decisions
                        about financing your education.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="peel-large-bottom"></div>

@endsection

@push('custom-disclaimers')
    <p class="text-footer-disclaimer">
        14 - APR Rates shown are effective as of 7/1/2020 to the best of our knowledge. For the most up to date rates, we
        recommend contacting our partners. APRs include discounts such as autopay discounts and/or relationship discounts.
        If approved for a loan, the rates and terms offered will depend on things like creditworthiness, the loan term,
        and other factors. Not all applicants qualify for the lowest rate. If approved for a loan, to qualify for the
        lowest rate, you must have a responsible financial history and meet other conditions.
        Each lender reserves the right to change interest rates at any time without notice.
    </p>
@endpush
