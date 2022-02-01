@extends('member.refinance-medical-in-fr-cities.recommended-base')

@section('deal-content')
    <div class="container">
        <a href="{{ url('/home') }}" class="text-brand-green">&#60; &nbsp;&nbsp;Back to Dashboard</a>
        <p class="primary mt-3"><a class="primary fw-600 fw-600" href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiation_group_id . '/refinance-deal-recommendation-questions') }}"><u>&#60; &nbsp;&nbsp;Change my answers</u></a></p>
    </div>
    <div class="page-wrapper campaign pt-5">
        <!-- banner start -->
        <div class="banner-sec mb-5">
            <div class="container">
                <div class="frow">
                    <div class="banner-content text-center">
                        <h3 class="mb-5">
                            Laurel Road offers competitive rates for refinancing your student loans.
                        </h3>
                        <h3>
                            As a Juno member, Laurel Road will offer you a <span class="text-brand-green">rate
                            reduction of 0.25%.</span> In addition, you may be able to pay back your medical school loans at only
                            <span class="text-brand-green">$100 per month</span> while in residency or fellowship. <a target="_blank" href="{{ asset('img/laurel-road-refi-disclosure-for-100-per-month.png') }}">*</a>
                        </h3>
                        <a
                            target="_blank"
                            rel="noreferrer"
                            href="{{ url('/member/deal/'.\App\Deal::DEAL_LAUREL_ROAD_REFINANCE_SLUG.'/hand-off') }}"
                            class="btn-voila bg-primary btn-md text-white cta mt-5"
                            style="max-width:300px;width:100%;padding:15px 20px;"
                        >
                            Check my rate
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner end -->

        <!-- form sec start -->
        <div class="form-sec" style="margin-top:0;">

            <h4 class="text-center text-black position-relative mb-5">
                Laurel Road Refinance Rates
                <svg
                    class="d-block mx-auto mt-2"
                    style="width:125px;"
                    viewBox="0 0 125 2">
                    <rect width="125" height="2"/>
                </svg>
            </h4>

            <div class="container">
                <div class="frow">
                    @include('member.deal-partials.rate-table',[
                        'title' => 'Check out the rates we negotiated',
                        'description' => 'We really wish we could tell you your exact rate, but everyone gets a different rate and we’re still honing our crystal ball skills.',
                        'cta_text' => 'Check my rate',
                        'cta_link' => url('/member/deal/'.\App\Deal::DEAL_LAUREL_ROAD_REFINANCE_SLUG.'/hand-off'),
                        'foot_note_marker' => '1',
                        'variable_rates' => [
                            ['term' => '5 Years', 'APR' => '1.74% - 4.80%'],
                            ['term' => '7 Years', 'APR' => '3.35% - 5.15%'],
                            ['term' => '10 Years', 'APR' => '3.75% - 5.45%'],
                            ['term' => '15 Years', 'APR' => '4.00% - 5.50%'],
                            ['term' => '20 Years', 'APR' => '4.25% - 6.08%'],
                        ],
                        'fixed_rates' => [
                            ['term' => '5 Years', 'APR' => '2.75% - 4.95%'],
                            ['term' => '7 Years', 'APR' => '3.35% - 5.25%'],
                            ['term' => '10 Years', 'APR' => '3.85% - 5.55%'],
                            ['term' => '15 Years', 'APR' => '4.25% - 5.60%'],
                            ['term' => '20 Years', 'APR' => '4.35% - 6.18%'],
                        ],
                        'notes_below_rates' => [
                            'APRs include Auto Pay rate reduction where applicable <a href="' . asset('img/laurel-road-refi-disclosure-for-100-per-month.png') . '" class="text-underline">*</a>. APRs include rate reduction of 0.25% for Juno members.',
                        ]
                    ])
                    <div class="rate-content">
                        <p class="text-dark font-semibold mt-3" style="line-height: 1.5">
                            Juno member offer cannot be combined with any other membership or organizational
                            bonuses and discounts.  |  No application or origination fees or prepayment penalties.
                            |
                            <a target="_blank" href="{{ asset('img/laurel-road-refi-disclosure-for-100-per-month.png') }}" class="text-underline">
                                Repayment Examples
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- form sec end -->


        <div class="py-5"></div>



        <!-- tweets sec end -->

        <!-- calculator-sec start -->
        <div class="calculator-sec bg-white">
            <div class="container">
                <div class="frow">
                    <h4 class="text-center text-black position-relative mb-5">
                        Features
                        <svg
                            class="d-block mx-auto mt-2"
                            style="width:125px;"
                            viewBox="0 0 125 2">
                            <rect width="125" height="2"/>
                        </svg>
                    </h4>
                    <div class="loan-details" data-scroll>
                        <div class="loan-points">
                            <ul>
                                <li><span>No fees for origination, disbursement, prepayment</span></li>
                                <li><span>0.25% Auto Pay discount <a target="_blank"  href="{{ asset('img/laurel-road-refi-disclosure-for-100-per-month.png') }}" class="text-underline">
                                *
                            </a></span></li>
                                <li><span>Pay back your medical school loans at only $100 per month while in residency
                                        or fellowship before beginning your standard repayment term<a target="_blank" href="{{ asset('img/laurel-road-refi-disclosure-for-100-per-month.png') }}" class="text-underline">
                                *
                            </a></span></li>
                            </ul>
                        </div>
                        <div class="right-img" data-scroll>
                            <img src="/assets/images/preson-with-tree.png" alt=" " />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- calculator-sec end -->
    </div>
@endsection

@include('member.deal.laurel-road-refinance._disclosures')

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
@endpush
