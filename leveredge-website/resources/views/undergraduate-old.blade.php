@extends('template.public')

@section('content')

    <div class="page-wrapper campaign pt-5">

    @php
        $heading = "We've negotiated a discounted student loan option for undergrads";
    @endphp

    <!-- banner start -->
        <div class="banner-sec">
            <div class="container">
                <div class="frow">
                    <div class="banner-content">
                        <div class="right-content">
                            <img src="/assets/images/airplane.png" alt="" />
                            <h1>{{ $heading }}</h1>
                            <p>We couldn't do it without the help of 15K+ students</p>
                        </div>
                        <div class="left-content">
                            <h1>{{ $heading }}</h1>
                            <form action="{{ url('/register') }}">
                                <div class="text-box">
                                    <input type="text" name="email" placeholder="Enter your email"/>
                                    <input type="submit" value="Access the Deal" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="img-div">
                <img class="desktop-img" src="/assets/images/banner-bottom-img.png" alt="" />
                <img class="mbl-img" src="/assets/images/banner-mbl.png" alt=" " />
            </div>
        </div>
        <!-- banner end -->

        <!-- form sec start -->
        <div class="form-sec" >
            <div class="container">
                <div class="frow">
                    <div class="form-inner">
                        <div class="left-title">
                            <div class="title">
                                <h4>Rates</h4>
                            </div>
                            <h3 data-scroll>Check out the Rates We Negotiated</h3>
                            <a href="{{ url('/register') }}" class="btn cta">Access the Deal</a>
                        </div>
                        <div class="right-form">
                            <div class="inner-content">
                                <div class="checkbox-div pl-0">
                                    {{--                                    <input type="checkbox" id="discount_terms" name="checkbox" checked="" />--}}
                                    <label for="discount_terms">Includes Auto Pay Discount</label>
                                </div>
                                <div class="lable-div">
                                    <div class="radio-box">
                                        <input type="radio" id="Fixed" name="form" value="Fixed" checked="" />
                                        <label for="Fixed">Fixed</label>
                                    </div>
                                    <div class="radio-box">
                                        <input type="radio" id="Variable" name="form" value="Variable" />
                                        <label for="Variable">Variable</label>
                                    </div>
                                </div>
                                <div class="form-content">
                                    <div class="fcol-2">
                                        <span>Term</span>
                                        <ul>
                                            <li>5 Years</li>
                                            <li>7 Years</li>
                                            <li>10 Years</li>
                                            <li>15 Years</li>
                                            <li>20 Years</li>
                                        </ul>
                                    </div>
                                    <div class="fcol-2">
                                        <span>APR</span>
                                        <ul>
                                            <li>4.23% - 6.94%</li>
                                            <li>4.23% - 6.94%</li>
                                            <li>4.23% - 6.94%</li>
                                            <li>4.23% - 6.94%</li>
                                            <li>4.23% - 6.94%</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rate-content" data-scroll>
                        <p>
                            LeverEdge member offer cannot be combined with any other membership or organizational bonuses and
                            discounts. | Rates include a 0.40% rate discount for LeverEdge members. | No application or origination
                            fees or prepayment penalties. | <a href="#">Repayment Examples</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- form sec end -->

        <!-- timeline start -->
        <div class="timeline-sec" >
            <div class="title">
                <h4>Negotiation Timeline</h4>
            </div>
            <div class="timeline-inner">
                <div class="timeline-content" data-scroll>
                    <div class="timeline-content-inner">
                        <div class="left-img">
                            <img src="/assets/images/timeline-img1.png" alt=" " />
                        </div>
                        <div class="right-content">
                            <div class="inner-content">
                                <span><i class="fa fa-check"></i> Completed</span>
                                <h3>Students Sign up</h3>
                                <p>Student join the LeverEdge Student Loan Negotiation Group for free.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timeline-content" data-scroll>
                    <div class="timeline-content-inner">
                        <div class="left-img">
                            <img src="/assets/images/timeline-img2.png" alt=" " />
                        </div>
                        <div class="right-content">
                            <div class="inner-content">
                                <span><i class="fa fa-check"></i> Completed</span>
                                <h3>Lenders Compete</h3>
                                <p>Lenders compete for your business by offering lower rate options for us to evaluate.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timeline-content" data-scroll>
                    <div class="timeline-content-inner">
                        <div class="left-img">
                            <img src="/assets/images/timeline-img3.png" alt=" " />
                        </div>
                        <div class="right-content">
                            <div class="inner-content">
                                <span><i class="fad fa-money-bill-wave"></i> Deal is now available!</span>
                                <h3>Loans Offered</h3>
                                <p>Members apply directly to the lender offering the lowest rates exclusively via LeverEdge.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- timeline end -->

        <!-- tweets sec start -->
        <div class="tweet-sec" >
            <div class="frow">
                <div class="tweet-inner">
                    <div class="tweet-img" style="background-image: url('/assets/images/tweet-img.png');">
                        <div class="play-text">
                            <img src="/assets/images/play-icon.svg" alt=" " />
                            <span>Watch Our Testimomial</span>
                        </div>
                    </div>
                    <div class="tweet-content">
                        <div class="tweet-content-inner" data-scroll>
                            <img src="/assets/images/quote.svg" alt=" " />
                            <p>
                                LeverEdge took so much of the stress out of financing my education and was able to
                                provide a loan on my terms with an interest rate under 5%.
                            </p>
                            <span class="name">Dan R</span>
                            <span class="branch-name">MIT - 2021</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- tweets sec end -->

        <!-- calculator-sec start -->
        <div class="calculator-sec bg-white">
            <div class="container">
                <div class="frow">
                    <div class="title">
                        <h4>Benefits of the Negotiated Deal</h4>
                    </div>
                    <div class="loan-details" data-scroll>
                        <div class="left-img" data-scroll>
                            <img src="/assets/images/preson-with-tree.png" alt=" " />
                        </div>
                        <div class="loan-points">
                            <ul>
                                <li><span>No early repayment penalty</span></li>
                                <li><span>1.00% Lower Rate</span> (compared to directly applying to the lender)</li>
                                <li><span>No application fee</span></li>
                                <li><span>No origination fee</span></li>
                                <li><span>0.25% Auto Pay Discount</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- calculator-sec end -->


        <!-- faq start -->
        <div class="faq-sec feature-sec" >
            <div class="container">
                <div class="frow">
                    <div class="faq-inner">
                        <div class="title">
                            <h4>FAQ</h4>
                        </div>
                        <div class="inner-content">
                            <div class="question">
                                Is a private student loan a good option for me?
                                <span class="icon"></span>
                            </div>
                            <div class="answer">
                                <p>
                                    Our job is to attract a large group of students to sign up. The more students who join our
                                    negotiation pool, the more leverage we have. That's how we get lenders to start competing against
                                    each other to offer you lower interest rates.
                                </p>
                            </div>
                        </div>
                        <div class="inner-content">
                            <div class="question">
                                What happens in case of death or total and permanent disability?
                                <span class="icon"></span>
                            </div>
                            <div class="answer">
                                <p>
                                    Our job is to attract a large group of students to sign up. The more students who join our
                                    negotiation pool, the more leverage we have. That's how we get lenders to start competing against
                                    each other to offer you lower interest rates.
                                </p>
                            </div>
                        </div>
                        <div class="inner-content">
                            <div class="question">
                                Is there a grace period? When does it apply?
                                <span class="icon"></span>
                            </div>
                            <div class="answer">
                                <p>
                                    Our job is to attract a large group of students to sign up. The more students who join our
                                    negotiation pool, the more leverage we have. That's how we get lenders to start competing against
                                    each other to offer you lower interest rates.
                                </p>
                            </div>
                        </div>
                        <div class="inner-content">
                            <div class="question">
                                When do I start getting the auto-pay discount?
                                <span class="icon"></span>
                            </div>
                            <div class="answer">
                                <p>
                                    Our job is to attract a large group of students to sign up. The more students who join our
                                    negotiation pool, the more leverage we have. That's how we get lenders to start competing against
                                    each other to offer you lower interest rates.
                                </p>
                            </div>
                        </div>
                        <div class="inner-content">
                            <div class="question">
                                How do I know I am getting the negotiated LeverEdge rate?
                                <span class="icon"></span>
                            </div>
                            <div class="answer">
                                <p>
                                    Our job is to attract a large group of students to sign up. The more students who join our
                                    negotiation pool, the more leverage we have. That's how we get lenders to start competing against
                                    each other to offer you lower interest rates.
                                </p>
                            </div>
                        </div>
                        <div class="inner-content">
                            <div class="question">
                                Why doesn't every LeverEdge member receive the same rate?
                                <span class="icon"></span>
                            </div>
                            <div class="answer">
                                <p>
                                    Our job is to attract a large group of students to sign up. The more students who join our
                                    negotiation pool, the more leverage we have. That's how we get lenders to start competing against
                                    each other to offer you lower interest rates.
                                </p>
                            </div>
                        </div>
                        <div class="inner-content">
                            <div class="question">
                                Laurel Road told me that I am not eligible, what should I do?
                                <span class="icon"></span>
                            </div>
                            <div class="answer">
                                <p>
                                    Our job is to attract a large group of students to sign up. The more students who join our
                                    negotiation pool, the more leverage we have. That's how we get lenders to start competing against
                                    each other to offer you lower interest rates.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="question-with-answer">
                        <div class="left-sec">
                            <h3>Got Questions? We Got Answers.</h3>
                        </div>
                        <div class="right-sec">
                            <p>
                                We understand that student loans and our negotiation process can be complicated. Please ask us any and
                                all questions you have.
                            </p>
                            <p>As a founder of LeverEdge, I check <a href="mailto:support@leveredge.org">support@leveredge.org</a> more frequently than my personal email.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- faq end -->

    </div>

@endsection

@push('header-scripts')
    <link rel="stylesheet" href="{{ asset('vendor/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/voila/campaign.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/fancybox/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/jquery-range/jquery.range.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/swiper/css/swiper.min.css') }}" />
@endpush

@push('footer-scripts')
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('/vendor/gsap/gsap.min.js') }}"></script>
    <script src="{{ asset('/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('/vendor/swiped-events/swiped-events.min.js') }}"></script>
    <script src="{{ asset('/vendor/jquery-range/jquery.range.js') }}"></script>
    <script src="{{ asset('/vendor/voila/campaign.js') }}"></script>
@endpush
