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

    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ url('/member/dashboard') }} "><i class="fa fa-arrow-left pr-2"></i> Go to Dashboard</a>
            </div>
        </div>
    </div>

    <div class="page-wrapper campaign pt-5">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="h3-class deal-heading">
                        Earnest Private Student Loans offer Juno Members
                        <span class="primary">1.00% lower rates</span> than you’d get if you directly applied
                        at Earnest!
                    </h3>
                    <a target="_blank" href="{{ url('/member/deal/'.\App\Deal::DEAL_EARNEST_UNDERGRAD_STUDENT_LOAN_20_21_SLUG.'/hand-off') }}" class="btn-voila cta mt-5">Check my rate</a>
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
                        'cta_text' => 'Check my rate',
                        'cta_link' => url('/member/deal/'.\App\Deal::DEAL_EARNEST_UNDERGRAD_STUDENT_LOAN_20_21_SLUG.'/hand-off'),
                        'variable_rates' => [
                            ['term' => '5 - 15 Years', 'APR' => '1.24% - 10.44%'],
                        ],
                        'fixed_rates' => [
                            ['term' => '5 - 15 Years', 'APR' => '4.00% - 11.78%'],
                        ],
                        'notes_below_rates' => [
                            'APRs include 0.25% Auto Pay rate reduction <sup class="foot-note-marker">3</sup>',
                            'APRs do not include additional Juno benefits'
                        ]
                    ])
                    <div class="rate-content">
                        <h5>How does this compare to rates from other lenders?</h5>
                        <p class="text-dark mt-3" style="line-height: 1.4">
                            To compare rates, you can apply to several lenders, receive your personalized quotes and compare them.
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
                            <img src="/assets/images/preson-with-tree.png" alt=" " />
                        </div>
                        <div class="loan-points">
                            <ul>
                                <li><span>0.25% Auto Pay Discount</span><sup class="foot-note-marker">3</sup></li>
                                <li><span>9-month grace period</span> (3 months more than most other lenders) <sup class="foot-note-marker">4</sup></li>
                                <li><span>No fees for origination, disbursement, prepayment, or late payment <sup class="foot-note-marker">5</sup></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- calculator-sec end -->

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


        @include('common.resources',[
            'hide_heading_section' => true,
            'page_specific_resources' => [
                [
                    'title' => 'Fixed vs. Variable <br> in 2020-21',
                    'description' => 'Need help deciding between fixed and variable rates? <br><br> Learn how you can evaluate which one is appropriate for you.',
                    'cta' => 'Learn More',
                    'link' => url('/fixed-vs-variable-20-21')
                ],
                [
                    'title' => 'Federal vs. Private for Grad Students',
                    'description' => 'Learn more about the trade-offs between Federally Held Student Loans and Private Student Loans.',
                    'cta' => 'Learn More',
                    'link' => url('/federal-vs-private-20-21')
                ]
            ]
        ])

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
        'aprFootnote' => '2 - Actual rate and available repayment terms will vary based on credit profile.
        Fixed rates range from 3.49% APR (with autopay) to 12.78% APR (excludes 0.25% Auto Pay discount).
        Variable rates range from 1.24% APR (with autopay) to 11.44% APR (excludes 0.25% Auto Pay discount).
        For variable rate loans, although the interest rate will vary after you are approved, the interest rate
        will never exceed 36% (the maximum allowable for these loans). Earnest variable interest rates are based
        on a publicly available index, the one month London Interbank Offered Rate (LIBOR). Your rate will be
        calculated each month by adding a margin between 1.34% and 11.54% to the one month LIBOR. Earnest rate
        ranges are current as of 9/23/2020. Earnest Private Student Loans are not available in Nevada.'
    ])
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
