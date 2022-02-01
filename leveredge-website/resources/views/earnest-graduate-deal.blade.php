@extends('template.public')

@push('header-scripts')
    <style>

        h3.deal-heading{
            font-size: 1.5rem;
            line-height: 1.5;
        }

        @media (min-width: 992px) {
            h3.deal-heading{
                font-size: 2rem;
                line-height: 1.5;
            }
        }

        a.btn-voila.cta{
            background-color: #278D87;
            color: #FFFFFF;
        }
        a.btn-voila.cta:hover{
            background-color: #278D87;
            color: #FFFFFF;
        }
    </style>
@endpush

@section('content')

    <div class="py-3 py-lg-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/' . $back_param) }} "><i class="fa fa-arrow-left pr-2"></i> Back to Recommendations</a>
            </div>
        </div>
    </div>

    <div class="page-wrapper campaign pt-5">

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="title mb-3">
                        <h4>Earnest Private Student Loans</h4>
                    </div>

                    <h4 class="h3-class deal-heading">
                        Negotiated rates are <span class="primary">at least 0.8% lower</span> than you would find directly on Earnest (for
                        Graduate no-cosigner loans with deferred payments and fixed rates) and <span class="primary">up to 4.00% lower</span>.
                    </h4>

                    <h4 class="h3-class deal-heading mt-4">
                        In addition, as a reward for being our member, Juno will give you <span class="primary">0.5% of your
                        loan amount</span> back out of our pocket. (e.g. $300 if your loan is for $60k)<sup class="foot-note-marker">5</sup>
                    </h4>

                    <a target="_blank" href="{{ url('/member/deal/'.\App\Deal::DEAL_EARNEST_GRAD_STUDENT_LOAN_20_21_SLUG.'/hand-off') }}" class="btn-voila cta mt-4">Check my rate</a>
                </div>
            </div>
        </div>


        <div class="py-5"></div>


        <!-- form sec start -->
        <div class="form-sec" >
            <div class="container">
                <div class="frow">
                    @include('member.deal-partials.rate-table',[
                        'title' => 'Check out the rates we negotiated',
                        'description' => 'We really wish we could tell you your exact rate, but everyone gets a different rate and we’re still honing our crystal ball skills.',
                        'default' => 'fixed',
                        'cta_text' => 'Check my rate',
                        'cta_link' => url('/member/deal/'.\App\Deal::DEAL_EARNEST_GRAD_STUDENT_LOAN_20_21_SLUG.'/hand-off'),
                        'variable_rates' => [
                            ['term' => '5 Years', 'APR' => '1.24% - 5.65%'],
                            ['term' => '7 Years', 'APR' => '3.75% - 5.70%'],
                            ['term' => '10 Years', 'APR' => '3.85% - 5.73%'],
                            ['term' => '12 Years', 'APR' => '4.05% - 5.88%'],
                            ['term' => '15 Years', 'APR' => '4.35% - 6.08%'],
                        ],
                        'fixed_rates' => [
                            ['term' => '5 Years', 'APR' => '3.49% - 6.05%'],
                            ['term' => '7 Years', 'APR' => '4.25% - 6.08%'],
                            ['term' => '10 Years', 'APR' => '4.35% - 6.10%'],
                            ['term' => '12 Years', 'APR' => '4.55% - 6.25%'],
                            ['term' => '15 Years', 'APR' => '4.85% - 6.45%'],
                        ],
                        'notes_below_rates' => [
                            'APRs include 0.25% Auto Pay rate reduction <sup class="foot-note-marker">3</sup>',
                            'APRs do not include additional Juno benefits',
                            'APRs are independent of your Juno cash reward, which is a one-time award dependent on your loan amount <sup class="foot-note-marker">6</sup>'
                        ]
                    ])
                    <div class="rate-content">
                        <h5>How does this compare to rates from other lenders?</h5>
                        <p class="text-dark mt-3" style="line-height: 1.4">
                            To compare rates, you can apply to several lenders and receive your personalized quote. Then, you can <a href="{{ url('calculator/graduate/compare-my-options') }}">use our
                                calculator</a> <sup class="foot-note-marker">6</sup> to compare any quotes you’ve received.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- form sec end -->

        <!-- calculator-sec start -->
        <div class="calculator-sec bg-white pt-5">
            <div class="container">
                <div class="frow">
                    <div class="title">
                        <h4>Benefits of Earnest</h4>
                    </div>
                    <div class="loan-details" data-scroll>
                        <div class="left-img" data-scroll>
                            <img src="{{ asset('img/bench-better.png') }}" alt=" " />
                        </div>
                        <div class="loan-points">
                            <ul>
                                <li><span>0.25% Auto Pay Discount</span><sup class="foot-note-marker">3</sup></li>
                                <li><span>9-month grace period</span> (3 months more than most other lenders) <sup class="foot-note-marker">4</sup></li>
                                <li><span>Juno Reward</span><br>0.50% of Loan Amount</li>
                                <li><span>No fees for origination, disbursement, prepayment, or late payment <sup class="foot-note-marker">5</sup></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- calculator-sec end -->

        <div class="py-5"></div>
        @include('member.deal-partials.leveredge-rewards-section' , [
	        'rewardText' => 'We give you 0.5% of your loan amount back when you use the Earnest negotiated deal.',
            'rewardsCalculated' => 'We’re giving you 0.5% of the loan you take using your special Juno link. So if you take out a loan for $60,000, you’re going to get a check for $300. No strings attached.'
        ])
        <div class="py-5"></div>

        <div class="w-100 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="title text-center mt-4">
                            <h4>Resources</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('common.resources',['hide_heading_section' => true])

        <div class="py-5"></div>


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


@push('custom-disclaimers')
    @include('legal._earnest-compliance-disclaimers', [
        'aprFootnote' => '2 - Actual rate and available repayment terms will vary based on credit profile. Fixed
        rates range from 3.49% APR (with autopay) to 6.90% APR (excludes 0.25% Auto Pay discount). Variable rates
        range from 1.24% APR (with autopay) to 6.50% APR (excludes 0.25% Auto Pay discount). For variable rate
        loans, although the interest rate will vary after you are approved, the interest rate will never exceed 36%
        (the maximum allowable for these loans). Earnest variable interest rates are based on a publicly available
        index, the one month London Interbank Offered Rate (LIBOR). Your rate will be calculated each month by
        adding a margin between 1.34% and 11.54% to the one month LIBOR. Earnest rate ranges are current as of
        9/23/2020. Earnest Private Student Loans are not available in Nevada.'
    ])

    <p class="text-footer-disclaimer">
        6 - Juno doesn’t guarantee the accuracy of its calculators. We encourage you to do your own calculations
        and/or consult with a licensed professional.
    </p>

@endpush


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
