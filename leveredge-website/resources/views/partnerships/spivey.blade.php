@extends('template.public')

@section('content')

    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-blue animated slideInDown">
        <div class="container mt-0 mb-0 pt-1 pb-1">
            <div class="row">
                <div class="col-12 text-center text-white">
                    Welcome Spivey Consulting Members!
                </div>
            </div>
        </div>
    </div>


    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-white" id="partnership-hero">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 text-left">
                    <h1>Need a loan for law school?</h1>
                    <h2>We use group buying power to negotiate down your loan rates.</h2>
                </div>

                <div class="col-12 col-md-6 mt-5 mt-md-0">
                    <div class="card negotiated-deal-shadow border-0">
                        <div class="card-body">
                            <img src="{{ url('/img/partnership/spivey-logo.jpg') }}" class="img-fluid">

                            <h3 class="mt-4">Free for students</h3>
                            <h3>It takes < 1 minute to join</h3>
                            @include('common.get-started-with-email-form')
                        </div>
                    </div>
                </div>
            </div>


{{--            <div class="row mt-5 justify-content-center">--}}
{{--                <div class="col-12">--}}
{{--                    <blockquote class="blockquote">--}}
{{--                        <p class="mb-0">Affordability and accessability in higher education, and decreasing student debt have always been major focus areas for NAGPS. <strong>Partnering with Juno</strong> helps us address these areas by providing so many graduate-professional students with access to low interest-rate student loans.</p>--}}
{{--                        <footer class="blockquote-footer mt-3">Rio DeLeon, <cite title="Source Title">NAGPS President</cite></footer>--}}
{{--                    </blockquote>--}}
{{--                </div>--}}
{{--            </div>--}}


        </div>
    </div>

    <div class="jumbotron mt-0 mb-0 pt-3 pt-md-0 pb-3 pb-md-0" id="partnership-logo-strip">
        <div class="container h-100 pt-0 pb-0 mt-0 mb-0">
            <div class="row h-100 justify-content-center">
                <div class="col-12 text-center">
                @php
                    $press_mentions = [
                    // ["Alone, students have no leverage to negotiate. But together, they can force lenders to compete.", url('/img/press-logo/above-the-law-horizontal.png')],
                        ["saving each student around $8,300 on their combined $25 million debt", url('/img/press-logo/wall-street-journal-bg-light-2.png')],
                        ["No one has seen an approach exactly like Juno’s.", url('/img/press-logo/boston-globe-logo-light.png')],
                        ["Two HBS admits took a look at interest rates... Then they got organized.", url('/img/press-logo/poets-and-quants-logo-bg-light.png')],
                        ["Together, students can force lenders to compete.", url('/img/press-logo/above-the-law-horizontal.png')],
                    ];
                @endphp


                <!-- Mobile Only Header -->
                    <p class="text-small d-md-none text-uppercase" style="color: #61717d;">
                        <strong>As Featured In</strong>
                    </p>

                    <!-- Desktop -->
                    <div class="card-deck mt-2 mb-2">
                        @foreach($press_mentions as $press)
                            <div class="card border-0 bg-transparent">
                                <div class="card-body text-center">
                                    <img src="{{ $press[1] }}" class="img-fluid" style="max-height: 24px;">
                                    <p class="text-small mt-3">
                                        "{{ $press[0] }}"
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>



                </div>
            </div>
        </div>
    </div>


    {{--    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-white">--}}
    {{--        @include('common.products',['hide_products_heading' => true])--}}
    {{--    </div>--}}


    <hr class="mt-0 mb-0 pb-0 pt-0">

    <div class="jumbotron mt-0 mb-0 bg-transparent">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2>Why Juno</h2>
                    <div class="separator"></div>

                    <h4 class="mt--3">
                        <i class="fas fa-check brand-color mr-2"></i>
                        <strong>Lower rates</strong>
                    </h4>
                    <p>
                        We bring a large amount of business to lenders and in return they offer lower interest rates for our members.
                    </p>
                    <p class="mt-3">
                        <a href="#how-we-negotiated-the-deals-new">Learn how the negotiation process works</a>.
                    </p>

                    <h4 class="mt-4">
                        <i class="fas fa-check brand-color mr-2"></i>
                        <strong>Completely free to use</strong>
                    </h4>
                    <p>
                        There are no fees for using our negotiated rates. Now that you're here, you have access.
                    </p>

                    <h4 class="mt-4">
                        <i class="fas fa-check brand-color mr-2"></i>
                        <strong>Vetted Lenders</strong>
                    </h4>
                    <p>
                        Beyond rates, we evaluate a lender's customer service and ease of application when selecting a lender.
                    </p>

                    <h4 class="mt-4">
                        <i class="fas fa-check brand-color mr-2"></i>
                        <strong>We’ve got your back</strong>
                    </h4>
                    <p>
                        We’re here to answer any questions along the way and ensure members receive rates and terms that are in line with expectations.
                    </p>
                    <p class="mt-3">
                        <a href="mailto:support@joinjuno.com">Email us</a> if you have any questions.
                    </p>
                </div>

                <div class="col-12 col-md-4 offset-md-2 text-center d-flex justify-content-center flex-column mt-5 mt-md-0">

                    @php
                        $images = [
                            "/img/reviews/facebook-ad-1-testimonial-largest-font.png",
                            // "/img/whatsapp-reviews/1.png",
                            "/img/reviews/facebook-ad-2-testimonial-largest-font.png",
                            // "/img/whatsapp-reviews/2.png",
                            "/img/reviews/facebook-ad-3-testimonial-largest-font.png",
                            // "/img/whatsapp-reviews/3.png",
                            "/img/reviews/facebook-ad-4-testimonial-largest-font.png",
                            // "/img/whatsapp-reviews/4.png",
                            "/img/reviews/facebook-ad-5-testimonial-largest-font.png",
                            "/img/reviews/facebook-ad-6-testimonial-largest-font.png",
                        ];
                    @endphp

                    @include('common.reviews-caroulsel',['images' => $images])


                </div>
            </div>
        </div>
    </div>

    <hr class="mt-0 mb-0 pb-0 pt-0">

    <div class="jumbotron mt-0 mb-0 bg-transparent" id="how-we-negotiated-the-deals-new">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <h2 class="text-center">HOW WE NEGOTIATED THE STUDENT LOAN</h2>
                    <div class="separator mx-auto mb-0"></div>
                    <h4 class="mt-4 text-center pb-3">Learn how we used group buying power to negotiate better student loans.</h4>

                    <div class="card-deck mt-5" id="how-it-works-new">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ url('/img/icons/teamwork.svg') }}" class="mt-3 img-fluid" style="max-height: 80px;">
                                <h2 class="mt-4">STUDENTS SIGN UP</h2>
                                <p class="mt-3 pr-1 pl-1">
                                    Students from top tier programs sign up to Juno by providing essential information.
                                </p>
                                <p class="mt-md-5 mt-3 text-blue completed-text">
                                    <i class="fas fa-check-circle"></i> Completed
                                </p>

                            </div>
                        </div>

                        <div class="d-md-none">
                            <hr>
                        </div>

                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ url('/img/icons/relationship.svg') }}" class="mt-3 img-fluid" style="max-height: 80px;">
                                <h2 class="mt-4">LENDERS COMPETE</h2>
                                <p class="mt-3 pr-1 pl-1">
                                    Banks submit their best bids including exclusive offers for Juno members.
                                </p>
                                <p class="mt-md-5 mt-3 text-blue completed-text">
                                    <i class="fas fa-check-circle"></i> Completed
                                </p>

                            </div>
                        </div>

                        <div class="d-md-none">
                            <hr>
                        </div>


                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ url('/img/icons/data-analysis.svg') }}" class="mt-3 img-fluid" style="max-height: 80px;">
                                <h2 class="mt-4">WE NEGOTIATE</h2>
                                <p class="mt-3 pr-1 pl-1">
                                    The Juno team compares all offers, negotiates terms, and selects a winner.
                                </p>
                                <p class="mt-md-5 mt-3 text-blue completed-text">
                                    <i class="fas fa-check-circle"></i> Completed
                                </p>

                            </div>
                        </div>


                        <div class="card highlight-card">
                            <div class="card-body text-center">
                                <img src="{{ url('/img/icons/loan-money.svg') }}" class="mt-3 img-fluid" style="max-height: 80px;">
                                <h2 class="mt-4">LOANS OFFERED</h2>
                                <p class="mt-3 pr-1 pl-1">
                                    Members get exclusive access to the Juno deal, including substantial rate discounts.
                                </p>
                                <p class="mt-md-5 mt-3 text-blue completed-text">
                                    <a href="{{ url('/negotiated-in-school-deal') }}" class="btn btn-primary">View Negotiated Deals</a>
                                </p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @guest
        <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-blue">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 text-center">
                        <h1 class="text-light">Get Started Today</h1>
                        <p class="text-light mt-3">
                            Joining Juno is free, takes less than 2 minutes and gets you access to the deals negotiated by Juno.
                        </p>
                        <form class="mt-4" method="get" action="{{ url('/register') }}">
                            @csrf
                            <div class="form-group text-left mb-0">
                                <div class="input-group mb-3">
                                    <input class="form-control" type="email" name="email" id="email" placeholder="Email Address">
                                    <div class="input-group-append">
                                        <button id="submit-enroll-form-button" class="btn btn-light">Get Started</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endguest

    <hr class="mt-0 mb-0 pt-0 pb-0">

    <div class="jumbotron mb-0 mt-0 bg-transparent">
        @include('common.testimonials')
    </div>

    <hr class="mt-0 mb-0 pt-0 pb-0">

    <div class="jumbotron mb-0 mt-0 bg-transparent">
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

    @guest
        <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-blue">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 text-center">
                        <h1 class="text-light">Get Started Today</h1>
                        <p class="text-light mt-3">
                            Joining Juno is free, takes less than 2 minutes and gets you access to the deals negotiated by Juno.
                        </p>
                        <form class="mt-4" method="get" action="{{ url('/register') }}">
                            @csrf
                            <div class="form-group text-left mb-0">
                                <div class="input-group mb-3">
                                    <input class="form-control" type="email" name="email" id="email" placeholder="Email Address">
                                    <div class="input-group-append">
                                        <button id="submit-enroll-form-button" class="btn btn-light">Get Started</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endguest

@endsection

@section('legal-disclosures')
    <p>There is no guarantee that a larger group will result in (additional) savings.</p>
    <p>We cannot guarantee that the rates and terms that are offered to you as part of a negotiation group are actually better than other options available to you.</p>
    <p>We cannot guarantee the accuracy of our calculators.</p>
@endsection


@push('footer-scripts')
    <!-- This sets the affiliate to NAGPS --->
    <img src="{{ url('/tracking-pixel.png?affiliate=nagps') }}">
@endpush
