@extends('template.public')

@php
    $numberOfStudents = \App\UserProfile::whereNotNull('university_id')
                            ->where('graduation_year','>',2020)->count();
@endphp

@section('content')


    <div class="page-wrapper campaign pt-5">

        @php
            $heading = "We negotiated discounted student loan options for ".  round($numberOfStudents/1000)   . "K+ undergrad students";
        @endphp

        <!-- banner start -->
        <div class="banner-sec">
            <div class="container">
                <div class="frow">
                    <div class="banner-content">
                        <div class="right-content">
                            <img src="/assets/images/airplane.png" alt="" />
                            <h1>{{ $heading }}</h1>
                            <p>Available now for everyone, including new members!</p>
                        </div>
                        <div class="left-content">
                            <h1>{{ $heading }}</h1>
                            <form action="{{ url('/register') }}">
                                <div class="form-group">
                                    <div class="input-group text-box">
                                        <input type="text" name="email" placeholder="Enter your email"/>
                                        <div class="input-group-append">
                                            <input type="submit" value="Access the Deal" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="img-div">
                <img class="desktop-img" src="{{ asset('img/undergraduate-public-progress-bar.png') }}" alt="" />
                <img class="mbl-img" src="{{ asset('img/undergraduate-public-progress-bar-mobile.png') }}" alt=" " />
            </div>
        </div>
        <!-- banner end -->

        <!-- form sec start -->
        <div class="form-sec" >
            <div class="container">
                <div class="frow">
                    @include('member.deal-partials.rate-table',[
                        'title' => 'Check out the rates we negotiated',
                        'description' => 'We really wish we could tell you your exact rate, but everyone gets a different rate and we’re still honing our crystal ball skills.',
                        'cta_text' => 'Access the Deal',
                        'cta_link' => url('/register'),
                        'foot_note_marker' => '1',
                        'variable_rates' => [
                            ['term' => '5 - 15 Years', 'APR' => '1.24% - 10.44%'],
                        ],
                        'fixed_rates' => [
                            ['term' => '5 - 15 Years', 'APR' => '4.00% - 11.78%'],
                        ],
                        'notes_below_rates' => [
                            'APRs include 0.25% Auto Pay rate reduction <sup>2</sup>',
                            'APRs do not include additional Juno benefits'
                        ]
                    ])
                    <div class="rate-content">
                        <h5>How does this compare to rates from other lenders?</h5>
                        <p class="text-dark mt-3" style="line-height: 1.4">
                            To compare rates, you can apply to several lenders and receive your personalized quote. Then, you can compare the quotes to decide which one is best for you. Don't forget to consider Federally held student loans before any private student loans.
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
                                <p>Students join the Juno Student Loan Negotiation Group for free.</p>
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
                                <p>Members apply directly to the lender offering the lowest rates exclusively via Juno.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- timeline end -->

{{--        <!-- tweets sec start -->--}}
{{--        <div class="tweet-sec" >--}}
{{--            <div class="frow">--}}
{{--                <div class="tweet-inner">--}}
{{--                    <div class="tweet-img" style="background-image: url('/assets/images/tweet-img.png');">--}}
{{--                        <div class="play-text">--}}
{{--                            <img src="/assets/images/play-icon.svg" alt=" " />--}}
{{--                            <span>Watch Our Testimomial</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="tweet-content">--}}
{{--                        <div class="tweet-content-inner" data-scroll>--}}
{{--                            <img src="/assets/images/quote.svg" alt=" " />--}}
{{--                            <p>--}}
{{--                                Juno took so much of the stress out of financing my education and was able to--}}
{{--                                provide a loan on my terms with an interest rate under 5%.--}}
{{--                            </p>--}}
{{--                            <span class="name">Dan R</span>--}}
{{--                            <span class="branch-name">MIT - 2021</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- tweets sec end -->--}}

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
                        @foreach($faqs as $faq)
                            <div class="inner-content">
                                <div class="question">
                                    {{ $faq['question'] }}
                                    <span class="icon"></span>
                                </div>
                                <div class="answer">
                                    {!! $faq['answer'] !!}
                                </div>
                            </div>
                        @endforeach
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
                            <p>As a founder of Juno, I check <a href="mailto:support@joinjuno.com">support@joinjuno.com</a> more frequently than my personal email.</p>
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

@push('custom-disclaimers')
    <p class="text-footer-disclaimer">
        Loans are made by a partner. Loans are not made by Juno.
    </p>

    <p class="text-footer-disclaimer">
        1 - Loan fees: The lender does not charge fees for origination, late payments, or prepayments. Florida Stamp Tax: For Florida residents, Florida documentary stamp tax is required by law, calculated as $0.35 for each $100 (or portion thereof) of the principal loan amount, the amount of which is provided in the Final Disclosure. Lender will add the stamp tax to the principal
        loan amount. The full amount will be paid directly to the Florida Department of Revenue.
    </p>

    <p class="text-footer-disclaimer">
        2 - You can take advantage of the Auto Pay interest rate reduction by setting up and maintaining active and automatic ACH withdrawal of your loan payment. The interest rate reduction for Auto Pay will be available only while your loan is enrolled in Auto Pay. Interest rate incentives for utilizing Auto Pay may not be combined with certain private student loan repayment
        programs that also offer an interest rate reduction. For multi party loans, only one party may enroll in Auto Pay.
    </p>

    <p class="text-footer-disclaimer">
        5 - Juno doesn’t guarantee the accuracy of its calculators. We encourage you to do your own calculations and/or consult with a licensed professional.
    </p>
@endpush
