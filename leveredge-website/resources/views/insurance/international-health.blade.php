@extends('template.public')

@push('header-scripts')
    <style>
        .banner {
            background-image:url(/assets/images/green-balloon-background.png);
            background-repeat:no-repeat;
            background-size:contain;
            background-position:90% 100%;
            padding-bottom:150px;
            position:relative;
            z-index:1;
        }
        p {
            font-weight:500;
        }
        .text-box {
            display:inline-block;
            position:relative;
        }
        .text-box input {
            border:none;
            height:50px;
            border-radius:25px;
            display:inline;
            width:100%;
            outline:none;
            font-weight:600;
        }
        .text-box .input-group-append {
            display:inline;
            position:absolute;
            right:0;
            top:0;
            bottom:0;
            float:right;
            width:40%;
        }
        .img-box {
            position:relative;
            height:0;
            padding-bottom:50%;
        }
        .img-box img {
            position:absolute;
            bottom:20px;
            left:50%;
            transform:translateX(-50%);
            height:auto;
            max-width:100%;
        }
        .square {
            position:relative;
            height:0;
            padding-bottom:100%;
        }
        .square img {
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%, -50%);
            height:auto;
            max-width:100%;
        }
        .partnerships-banner {
            z-index:-1;
            margin-top:-5px;
        }
        .bg-light-green {
            background:linear-gradient(0deg,#EDF6F5,#EDF6F5),linear-gradient(180deg,#f3f4ed,#fff 50%);
        }
        .partnerships-banner p {
            font-size:12px;
        }
        h4 {
            font-family:'CooperMediumBT', serif;
            position:relative;
        }
        h4.underlined:after {
            content:'';
            position:absolute;
            left:50%;
            bottom:-5px;
            width:50px;
            margin-left:-25px;
            border-bottom:3px solid #3F3356;
        }
        .faq,
        .how-it-works {
            box-shadow:0 2px 5px rgba(0,0,0,.1);
            border-radius:10px;
        }
        .how-it-works {
            background:url(/assets/images/Peel.png) no-repeat;
            background-position:bottom left;
            border-bottom-left-radius:40px;
            padding:3rem;
        }
        .how-it-works a:hover {
            color:#3F3356;
            opacity:.75;
        }
        .how-it-works h4 {
            font-size:20px;
        }
        .how-it-works p {
            font-size:14px;
        }
        a.rates-button {
            border-radius:21px;
            font-size:16px;
        }
        .faq-content {
            outline:none;
        }
        .faq-content .question {
            position:relative;
        }
        .faq-content .question p {
            font-weight:600;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .faq-content .icon {
            position:absolute;
            margin-top:3rem;
            margin-right:3rem;
            right:0;
            top:0;
            height:16px;
            width:16px;
            pointer-events:none;
        }
        .faq-content .icon,
        .faq-content .question {
            pointer-events:none;
            outline:none;
        }
        .faq-content .icon:before,
        .faq-content .icon:after {
            content: '';
            position:absolute;
            top:50%;
            left:50%;
            background-color:#2F706B;
            transform:translate(-50%, -50%);
            transition:all .4s;
            border-radius:2px;
        }
        .faq-content .icon:before {
            height:100%;
            width:3px;
        }
        .faq-content .icon:after {
            height:3px;
            width:100%;
        }
        .faq-content:focus .icon,
        .faq-content:focus .question {
            pointer-events:auto;
        }
        .faq-content:focus .icon:before,
        .faq-content:focus .icon:after,
        .faq-content .answer:focus-within ~ .icon:before,
        .faq-content .answer:focus-within ~ .icon:after {
            transform:translate(-50%, -50%) rotate(-90deg);
        }
        .faq-content:focus .icon:after,
        .faq-content .answer:focus-within .icon:after {
            opacity:0;
        }
        .faq-content .answer {
            opacity:0;
            max-height:0;
            transition:all .4s linear;
            overflow:hidden;
        }
        .faq-content:focus .answer,
        .faq-content .answer:focus-within {
            opacity:1;
            max-height:500px;
            padding:0 3rem 3rem;
        }
        @media screen and (max-width:768px) {
            h1 {
                font-size:30px;
            }
            .how-it-works {
                padding:1rem 1rem 5rem;
            }
            .how-it-works .square {
                padding-bottom:60%;
            }
            .how-it-works .square img {
                max-width:50%;
            }
            .how-it-works .left-col {
                padding:0;
            }
            .faq-content {
                padding:2rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid pt-5">
        <div class="container banner px-0">
            <div class="col-12 col-lg-7 px-0">
                <h1 class="off-black mb-5">A more affordable health insurance for internationals</h1>
                <form action="{{ url('/register') }}" class="pt-3">
                    <div class="form-group pr-lg-5">
                        <div class="text-box col-12 px-0">
                            <input
                                type="text"
                                name="email"
                                placeholder="Enter your email"
                                class="bg-light pl-3 pr-5"
                            />
                            <div class="input-group-append">
                                <input
                                    type="submit"
                                    value="Sign Up"
                                    class="bg-secondary"
                                />
                            </div>
                        </div>
                    </div>
                </form>
                <p class="font-semibold">
                    Save money on health insurance
                    <br/>
                    when you join for free
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid partnerships-banner bg-light-green">
        <div class="container px-0">
            <div class="row">
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="img-box">
                        <img src="{{ asset('/img/press-logo/tc.png') }}">
                    </div>
                    <p class="font-small text-muted">
                        “Juno is taking that one-off experience and systemizing it for more students in more contexts.”
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="img-box">
                        <img src="{{ asset('/img/press-logo/wall-street-journal-bg-light.png') }}">
                    </div>
                    <p class="font-small text-muted">
                        “Saving each student around $8,300 on their combined $25 million debt”
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="img-box">
                        <img src="{{ asset('/img/press-logo/boston-globe-logo-light.png') }}">
                    </div>
                    <p class="font-small text-muted">
                        “No one has seen an approach exactly like Juno’s”
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-2 d-none d-md-block">
                    <div class="img-box">
                        <img src="{{ asset('/img/press-logo/poets-and-quants-logo-bg-light.png') }}">

                    </div>
                    <p class="font-small text-muted">
                        “Two HBS admits took a look at interest rates... Then they got organized.
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-2 d-none d-md-block">
                    <div class="img-box">
                        <img src="{{ asset('/img/press-logo/above-the-law-horizontal.png') }}">
                    </div>
                    <p class="font-small text-muted">
                        “Together, students can force lenders to compete”
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="img-box">
                        <img src="{{ asset('/img/press-logo/yahoo-finance.png') }}">
                    </div>
                    <p class="font-small text-muted">
                        “Anything that empowers students during the borrowing process is a positive development”
                    </p>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="container-fluid bg-light">--}}
{{--        <div class="container px-0 py-5">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <h4 class="off-black font-secondary text-center underlined">--}}
{{--                        How does it work?--}}
{{--                    </h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-12 mt-5 how-it-works bg-white">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-12 col-lg-5 left-col p-5">--}}
{{--                            <h1>How it works</h1>--}}
{{--                            <p class="font-semibold">--}}
{{--                                We are working with Global Benefits Group (GBG), a renowned insurance provider,--}}
{{--                                to provide affordable insurance for our international members.--}}
{{--                            </p>--}}
{{--                            <a href="" class="font-weight-bold off-black">--}}
{{--                                <u>Sign up to get started</u>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="d-block d-sm-none my-5">--}}
{{--                            <hr>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-lg-7">--}}
{{--                            <div class="row text-center text-md-left">--}}
{{--                                <div class="col-12 col-md-4">--}}
{{--                                    <div class="square">--}}
{{--                                        <img--}}
{{--                                            alt="Students sitting on the ground with a laptop"--}}
{{--                                            src="{{ asset('/img/insurance/students-sitting-on-ground-with-laptop.png') }}"--}}
{{--                                        >--}}
{{--                                    </div>--}}
{{--                                    <h4 class="text-primary">--}}
{{--                                        Sign up to start--}}
{{--                                    </h4>--}}
{{--                                    <p>--}}
{{--                                        Students join Juno for free. No commitment to use our deal.--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-md-4">--}}
{{--                                    <div class="square">--}}
{{--                                        <img--}}
{{--                                            alt="Two students walking and talking"--}}
{{--                                            src="{{ asset('/img/insurance/two-students-walking-and-talking.png') }}"--}}
{{--                                        >--}}
{{--                                    </div>--}}
{{--                                    <h4 class="text-primary">--}}
{{--                                        Spread the word--}}
{{--                                    </h4>--}}
{{--                                    <p>--}}
{{--                                        Go to your dashboard and click on the deal to get redirected to our partner’s portal.--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-md-4">--}}
{{--                                    <div class="square">--}}
{{--                                        <img--}}
{{--                                            alt="Students holding back a hot-air balloon"--}}
{{--                                            src="{{ asset('/img/insurance/students-holding-balloon.png') }}"--}}
{{--                                        >--}}
{{--                                    </div>--}}
{{--                                    <h4 class="text-primary">--}}
{{--                                        The deal is ready--}}
{{--                                    </h4>--}}
{{--                                    <p>--}}
{{--                                        Invite those you care about and be rewarded. You’ll earn 1% cash back on the--}}
{{--                                        cost of your insurance plan for each additional person you refer who takes--}}
{{--                                        the deal, on top of the 5% back you receive just for being a member.--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="container px-0">--}}
{{--            <div class="row mt-5 py-5">--}}
{{--                <div class="col-12">--}}
{{--                    <h4 class="off-black font-secondary text-center underlined">--}}
{{--                        The features--}}
{{--                    </h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="container-fluid py-3">
        <div class="container px-0">
            <div class="row align-items-center text-center text-md-left py-5">
                <div class="col-12 offset-md-1 col-md-4 order-md-2">
                    <img
                        src="{{ asset('/img/better-loans.png') }}"
                        style="max-width:300px;"
                    >
                </div>
                <div class="col-12 col-md-7 order-md-1">
                    <h1 class="off-black mb-3">More affordable than a university's insurance plan</h1>
                    <p>
                        We did the math and you could save  $1,000 - $3,000 per year. We also made sure the coverage
                        meets your university requirements.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light-green py-5">
        <div class="container px-0">
            <div class="row align-items-center text-center text-md-left py-5">
                <div class="col-12 col-md-4">
                    <img
                        src="{{ asset('/img/spring-season-with-check.png') }}"
                        style="max-width:300px;"
                    >
                </div>
                <div class="col-12 offset-md-1 col-md-7 text-center text-md-right">
                    <h1 class="off-black mb-3">Guaranteed University Acceptance of Waiver</h1>
                    <p>
                        GBG will refund any amount that you have paid for the plan if
                        the university rejects your waiver request
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-3">
        <div class="container px-0">
            <div class="row align-items-center text-center text-md-left py-5">
                <div class="col-12 col-md-4 offset-md-1 order-md-2">
                    <img
                        src="{{ asset('/img/coins-in-safe.png') }}"
                        style="max-width:300px;"
                    >
                </div>
                <div class="col-12 col-md-7 order-md-1">
                    <h1 class="off-black mb-3">
                        Earn rewards with every friend you refer along the way.
                    </h1>
                    <p>
                        You’ll get <span class="text-primary">an additional 1%</span> for every person who takes the same deal, up to 5% total.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid py-3 bg-light-green">
        <div class="container px-0">
            <div class="row align-items-center justify-content-center text-center text-md-left py-5 mb-5">
                <div class="col-12 text-center px-0">
                    <img
                        class="img-fluid mb-2 d-none d-sm-block"
                        src="{{ asset('/img/undergraduate-public-progress-bar.png') }}"
                    >
                    <img
                        class="img-fluid mb-2 d-block d-sm-none"
                        src="{{ asset('/img/undergraduate-public-progress-bar-mobile.png') }}"
                    >
                    <h1 class="off-black mb-3">Thousands of members helped us get here</h1>
                </div>
                <div class="col-12 col-lg-7 text-center">
                    <p class="mb-5">
                        Thanks to our community, we’ve successfully negotiated a deal for our members.
                        Now, you’re free to join and access those same options.
                    </p>
                    <a
                        href="{{ url('/register') }}"
                        class="btn btn-lg bg-secondary font-weight-bold px-5 rates-button"
                    >
                        Access the deal
                    </a>
                </div>
            </div>
        </div>
        <div class="container bg-white faq">
            <div class="row">
                <div class="col-12 p-5">
                    <h5 class="font-weight-bold text-center">FAQ</h5>
                </div>
            </div>
            @foreach($faqs as $faq)
                <div class="row">
                    <div tabindex="0" class="faq-content col-12 border-top">
                        <div class="question p-5" tabindex="-1">
                            <p class="mb-0">
                                {{ $faq['question'] }}
                            </p>
                        </div>
                        <div class="answer px-5">
                            <p>
                                {!! $faq['answer'] !!}
                            </p>
                        </div>
                        <span class="icon" tabindex="-1" aria-hidden="true"></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
