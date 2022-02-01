@extends('template.public')

@php
$numberOfStudents = \App\UserProfile::whereNotNull('grad_university_id')
                        ->where('grad_graduation_year','>',2020)->count();
@endphp

@section('content')

    @include('common._banner_graduate_student_loan_calculator')

    <div class="page-wrapper campaign pt-5">

        @php
        $heading = "We negotiated discounted student loan options for ".  round($numberOfStudents/1000)   . "K+ grad students";
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
                <img class="desktop-img" src="{{ asset('img/graduate-public-progress-bar.png') }}" alt="" />
                <img class="mbl-img" src="{{ asset('img/graduate-public-progress-bar-mobile.png') }}" alt=" " />
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
                                ['term' => '5 Years', 'APR' => '1.24% - 5.65%'],
                                ['term' => '7 Years', 'APR' => '3.65% - 5.75%'],
                                ['term' => '10 Years', 'APR' => '2.64% - 5.80%'],
                                ['term' => '12 Years', 'APR' => '3.95% - 6.10%'],
                                ['term' => '15 Years', 'APR' => '2.84% - 6.50%'],
                            ],
                            'fixed_rates' => [
                                ['term' => '5 Years', 'APR' => '3.49% - 6.05%'],
                                ['term' => '7 Years', 'APR' => '4.15% - 6.15%'],
                                ['term' => '10 Years', 'APR' => '4.25% - 6.20%'],
                                ['term' => '12 Years', 'APR' => '4.45% - 6.50%'],
                                ['term' => '15 Years', 'APR' => '4.75% - 6.90%'],
                            ],
                            'notes_below_rates' => [
                                'APRs include Auto Pay rate reduction where applicable<sup class="foot-note-marker">2</sup>',
                                'APRs do not include additional Juno benefits'
                            ]
                        ])
                        <div class="rate-content">
                            <h5>How does this compare to rates from other lenders?</h5>
                            <p class="text-dark mt-3" style="line-height: 1.4">
                                To compare rates, you can apply to several lenders and receive your personalized quote. Then, you can <a href="{{ url('/calculator/graduate/compare-my-options') }}">use our
                                    calculator</a> <sup class="foot-note-marker">5</sup>to compare any quotes you’ve received.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- form sec end -->


            <div class="py-5"></div>

            @include('member.deal-partials.leveredge-rewards-section' , [
	        'rewardText' => 'We give you at least 0.5% of your loan amount back when you use one of our negotiated deals.',
            'rewardsCalculated' => 'We’re giving you at least 0.5% of the loan you take using your special Juno link. So if you take out a loan for $60,000, you’re going to get a check for at least $300. No strings attached.'
        ])

            <div class="py-5"></div>



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
                                <p>Student join the Juno Student Loan Negotiation Group for free.</p>
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

        <!-- tweets sec start -->
        <div class="tweet-sec" >
            <div class="frow">
                <div class="tweet-inner">
                    <div class="tweet-img" style="background-image: url('/assets/images/tweet-img.png');">
{{--                        <div class="play-text">--}}
{{--                            <img src="/assets/images/play-icon.svg" alt=" " />--}}
{{--                            <span>Watch Our Testimomial</span>--}}
{{--                        </div>--}}
                    </div>
                    <div class="tweet-content">
                        <div class="tweet-content-inner" data-scroll>
                            <img src="/assets/images/quote.svg" alt=" " />
                            <p>
                                Juno took so much of the stress out of financing my education.
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
                                <li><span>Juno Cash Reward</span><br>At least 0.50% of Loan Amount</li>
                                <li><span>No early repayment penalty</span></li>
                                <li><span>Up to 4.00% Lower Rate</span> <br>(compared to directly applying to a lender)</li>
                                <li><span>No application fee</span></li>
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
    <link rel="stylesheet" href="{{ asset('mix/css/pages/graduate.css') }}">
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
        Loans are not made by Juno. Loans are made by a partner or a partner's partner. The rates represent a combination of rates available through several partners.
    </p>

    <p class="text-footer-disclaimer">
    1 - Loan fees: The lenders do not charge fees for prepayments. Florida Stamp Tax: For Florida residents, Florida documentary stamp tax is required by law, calculated as $0.35 for each $100 (or portion thereof) of the principal loan amount, the amount of which is provided in the Final Disclosure. Lender may add the stamp tax to the principal
    loan amount. The full amount will be paid directly to the Florida Department of Revenue. Some lenders may charge origination fees.
    </p>

    <p class="text-footer-disclaimer">
    2 - Where available, you can take advantage of the Auto Pay interest rate reduction by setting up and maintaining active and automatic ACH withdrawal of your loan payment. The interest rate reduction for Auto Pay will be available only while your loan is enrolled in Auto Pay. Interest rate incentives for utilizing Auto Pay may not be combined with certain private student loan repayment
    programs that also offer an interest rate reduction. For multi party loans, only one party may enroll in Auto Pay.
    </p>

    <p class="text-footer-disclaimer">
    5 - Juno doesn’t guarantee the accuracy of its calculators. We encourage you to do your own calculations and/or consult with a licensed professional.
    </p>
@endpush
