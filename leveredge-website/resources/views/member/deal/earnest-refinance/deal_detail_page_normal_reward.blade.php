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

    @include('member._without_job_and_federal_info')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id) }} "><i class="fa fa-arrow-left pr-2"></i> Back to Deals</a>
            </div>
        </div>
    </div>

    <div class="page-wrapper campaign pt-5">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="h3-class deal-heading text-center">
                        Earnest offers competitive rates for refinancing your student loans.
                    </h3>
                    <h3 class="h3-class deal-heading mt-4 text-center">
                        In addition, as a reward for being our member, you will receive between $500 and $1,000 depending on the loan amount.<sup style="font-size: 24px;" class="foot-note-marker">7</sup>
                    </h3>
                    <p class="text-center">
                        <a target="_blank" href="{{ url('/member/deal/'.\App\Deal::DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_SLUG.'/hand-off') }}" class="btn-voila cta mt-4">Check my rate</a>
                    </p>
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
                        'default' => 'variable',
                        'cta_text' => 'Check my rate',
                        'cta_link' => url('/member/deal/'.\App\Deal::DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_SLUG.'/hand-off'),
                        'variable_rates' => [
                            ['term' => '5 Years', 'APR' => 'Starting at 1.99%'],
                        ],
                        'fixed_rates' => [
                            ['term' => '5 Years', 'APR' => 'Starting at 2.98%'],
                        ],
                        'notes_below_rates' => [
                            'APRs include 0.25% Auto Pay discount <sup class="foot-note-marker">3</sup>',
                            'APRs do not include additional Juno benefits',
                            'APRs are independent of your Juno cash reward, which is a one-time award dependent on your loan amount <sup class="foot-note-marker">6</sup>',
                            'Variable rates not available in AK, IL, MN, NH, OH, TN, and TX.'
                        ]
                    ])
{{--                    <div class="rate-content">--}}
{{--                        <h5>How does this compare to rates from other lenders?</h5>--}}
{{--                        <p class="text-dark mt-3" style="line-height: 1.4">--}}
{{--                            To compare rates, you can apply to several lenders and receive your personalized quote. Then, you can <a href="{{ url('calculator/graduate/compare-my-options') }}">use our--}}
{{--                                calculator</a> <sup class="foot-note-marker">5</sup> to compare any quotes you’ve received.--}}
{{--                        </p>--}}
{{--                    </div>--}}
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
                                <li>Consolidate your private and federal loans</li>
                                <li>Select autopay to never miss a loan payment</li>
                                <li>Make extra or early payments without prepayment penalties</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- calculator-sec end -->

        <div class="py-5"></div>
        @include('member.deal-partials.leveredge-rewards-section' , [
	        'rewardText' => 'We give you up to $500 depending on your loan amount when you refinance using our negotiated deal with Earnest.',
            'rewardsCalculated' => 'If you borrow up to $75K, you won\'t receive any Juno Rewards. Between $75K and $100K, you\'ll receive $250. For amounts above $100K, you\'ll receive $500. The Juno Rewards are in addition to the bonus you receive from Earnest',
            'termsUrl' => '/leveredge-rewards/terms-refinance'
        ])
        <div class="py-5"></div>

{{--        <div class="w-100 bg-white">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="title text-center mt-4">--}}
{{--                            <h4>Resources</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


{{--        @include('common.resources',['hide_heading_section' => true])--}}

{{--        <div class="py-5"></div>--}}


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
        'aprFootnote' => '2 - Actual rate and available repayment terms will vary based on your credit profile.
        Fixed rates range from 2.98% APR (with autopay) to 5.79% APR (excludes 0.25% Auto Pay discount). Variable
        rates range from 1.99% APR (with autopay) to 5.64% APR (excludes 0.25% Auto Pay discount). For variable rate
        loans, although the interest rate will vary after you are approved, the interest rate will never exceed
        8.95% if your loan term is 10 years or less. For loan terms of more than 10 years to 15 years, the interest
        rate will never exceed 9.95%. For loan terms over 15 years, the interest rate will never exceed 11.95%.
        Earnest variable interest rate student loan refinance loans are based on a publicly available index,
        the one month London Interbank Offered Rate (LIBOR). Your rate will be calculated each month by adding a
        margin between 2.09% and 5.74% to the one month LIBOR. Earnest rate ranges are current as of 9/23/2020.
        Please note, Earnest is not able to offer variable rate loans in AK, IL, MN, NH, OH, TN, and TX.'
    ])
    <p class="text-footer-disclaimer">
        6 - APRs are independent of the Juno cash rewards.
    </p>
    <p class="text-footer-disclaimer">
        7 -
        Earnest Welcome Bonus Offer Disclosure: Terms and conditions apply. To qualify for this Earnest Welcome Bonus
        offer: 1) you must not currently be an Earnest client, or have received the bonus in the past, 2) you must
        submit a completed student loan refinancing application through the designated LeverEdge Association's link; 3) you must
        provide a valid email address and a valid checking account number during the application process; and 4) your
        loan must be fully disbursed. The bonus will be automatically transmitted to your checking account after the
        final disbursement. There is a limit of one bonus per borrower. This offer is not valid for current Earnest
        clients who refinance their existing Earnest loans, clients who have previously received a bonus, or with any
        other bonus offers received from Earnest. Bonus cannot be issued to residents in KY, MA, or MI. Individual bonus offers may not be combined.
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
