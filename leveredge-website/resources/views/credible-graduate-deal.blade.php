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
                <a href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/' . $back_param) }} "><i class="fa fa-arrow-left pr-2"></i> Back to Recommendations</a>
            </div>
        </div>
    </div>

    <div class="page-wrapper campaign pt-5">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="h3-class deal-heading">
                        Credible offers the <span class="primary">lowest variable rates</span> we expect you will receive.
                    </h3>

                    <h3 class="h3-class deal-heading mt-4">
                        In addition, as a reward for being our member, Juno will give you <span class="primary">1% of your
                        loan amount</span> back out of our pocket. (e.g. $600 if your loan is for $60k)
                    </h3>

                    <a target="_blank" href="{{ url('/member/deal/'.\App\Deal::DEAL_CREDIBLE_STUDENT_LOAN_SLUG.'/hand-off') }}" class="btn-voila cta mt-4">Check my rate</a>
                </div>
            </div>
        </div>

        <div class="py-5"></div>

        <!-- form sec start -->
        <div class="form-sec" >
            <div class="container">
                <div class="frow">
                    @include('member.deal-partials.rate-table',[
                        'title' => 'Check out the rates from Credible',
                        'description' => 'We really wish we could tell you your exact rate, but everyone gets a different rate and we’re still honing our crystal ball skills.',
                        'cta_text' => 'Check my rate',
                        'cta_link' => url('/member/deal/'.\App\Deal::DEAL_CREDIBLE_STUDENT_LOAN_SLUG.'/hand-off'),
                        'variable_rates' => [
                            ['term' => '5-20 Years', 'APR' => '1.24% - 11.99%'],
                        ],
                        'fixed_rates' => [
                            ['term' => '5-20 Years', 'APR' => '3.82% - 12.39%'],
                        ],
                        'notes_below_rates' => [
                            'APRs include Auto Pay discounts where available <sup class="foot-note-marker">2</sup>',
                            'APRs do not include additional Juno benefits',
                            'APRs are independent of your Juno cash reward, which is a one-time award dependent on your loan amount. <sup class="foot-note-marker">6</sup>'
                        ]
                    ])
                    <div class="rate-content">
                        <h5>How does this compare to rates from other lenders?</h5>
                        <p class="text-dark mt-3" style="line-height: 1.4">
                            To compare rates, you can apply to several lenders and receive your personalized quote. Then, you can <a href="{{ url('/calculator/graduate/compare-my-options') }}">use our
                                calculator</a> <sup class="foot-note-marker">5</sup> to compare any quotes you’ve received.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- form sec end -->


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
                                <li><span>Juno Cash Reward</span><br>1% of Loan Amount</li>
                                <li><span>No fees for origination, disbursement or prepayment <sup class="foot-note-marker">1</sup></span></li>
                                <li><span>0.25% Auto Pay Discount</span><sup class="foot-note-marker">2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- calculator-sec end -->

        <div class="py-5"></div>

        @include('member.deal-partials.leveredge-rewards-section' , [
            'rewardText' => 'We give you 1.0% of your loan amount back when you use the Credible offer.',
            'rewardsCalculated' => 'We’re giving you 1.0% of the loan you take using your special Juno link. So if you take out a loan for $60,000, you’re going to get a check for $600. No strings attached.'
        ])

        <div class="py-5"></div>

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
    <p class="text-footer-disclaimer">
        See Credible for more
    </p>
    <p class="text-footer-disclaimer">
        1, 2, 3 - Student Loan Rate and Terms Disclosure: Rates displayed include Automatic Payment and Loyalty Discounts,
        where applicable. Note that such discounts do not apply while loans are in deferment. The lenders on the
        Credible.com platform offer fixed rates ranging from 3.82% - 14.50% APR and Variable interest rates from
        1.29% - 12.99% APR. Variable rates will fluctuate over the term of the borrower’s loan with changes in the
        LIBOR rate. Rates are subject to change at any time without notice. Your actual rate may be different from
        the rates advertised and/or shown above and will be based on factors such as the term of your loan, your
        financial history (including your cosigner’s (if any) financial history) and the degree you are in the process
        of achieving or have achieved. While not always the case, lower rates typically require creditworthy applicants
        with creditworthy co-signers, graduate degrees, and shorter repayment terms (terms vary by lender and can range
        from 5-20 years) and include Automatic Payment and Loyalty discounts, where applicable. Loyalty and Automatic
        Payment discount requirements as well as Lender terms and conditions will vary by lender and therefore, reading
        each lender’s disclosures is important. Additionally, lenders may have loan minimum and maximum requirements,
        degree requirements, educational institution requirements, citizenship and residency requirements as well as
        other lender-specific requirements.
    </p>

    <p class="text-footer-disclaimer">
        4 - Visit Credible.com for loan cost examples
    </p>
    <p class="text-footer-disclaimer">
        5 - Juno doesn’t guarantee the accuracy of its calculators. We encourage you to do your own calculations and/or consult with a licensed professional.
    </p>

    <p class="text-footer-disclaimer">
        6 - APRs are independent of the Juno cash rewards. Your cash reward is a one-time payment of 1.0% of your Credible loan amount (for example on a $60k loan your reward would be $600).
    </p>
@endpush


@push('header-scripts')
    <link rel="stylesheet" href="{{ asset('vendor/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/voila/campaign.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/jquery-range/jquery.range.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/swiper/css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('mix/css/pages/graduate.css') }}">
@endpush

@push('footer-scripts')
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('/vendor/gsap/gsap.min.js') }}"></script>
    <script src="{{ asset('/vendor/jquery-range/jquery.range.js') }}"></script>
    <script src="{{ asset('/vendor/voila/campaign.js') }}"></script>
@endpush
