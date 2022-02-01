@extends('template.public')

@push('header-scripts')
    <link href="{{mix('mix/css/components/first-republic-calculator.css')}}" rel="stylesheet" type="text/css">
    <style>

        h3.deal-heading{
            font-size: 1.5rem;
            line-height: 1.5;
        }

        h3.deal-heading .text-small{
            font-weight: 500;
            font-family: "GTWalsheimPro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.15rem;
        }

        @media (min-width: 992px) {
            h3.deal-heading{
                font-size: 2rem;
                line-height: 1.5;
            }

            h3.deal-heading .text-small{
                font-size: 1.5rem;
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

        .text-small{
            font-size: 80%;
        }
    </style>
@endpush

@section('content')
    <div class="py-3 py-lg-5"></div>

    @include('member._without_job_and_federal_info')

    <div class="container">
        <div class="row">
            <div class="col-12">

                <p class="primary mb-4"><a class="primary fw-600" href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/refinance-deal-recommendation-questions' ) }}">Change my answers</a></p>

                <h3 class="h3-class deal-heading">
                    We expect First Republic's Personal Line of Credit <sup class="foot-note-marker">1</sup> offers the <span class="secondary-green">most affordable</span> option to refinance your student loans and more.
                </h3>

                <h3 class="h3-class deal-heading mt-3">
                    In addition, as a reward for being our member, <span class="primary">you will receive up to $800*</span>.
                    <br>
                    <span class="text-small">*Up to $400 from Juno and up to $400 from First Republic <sup class="foot-note-marker">2</sup></span>
                </h3>
                <a target="_blank" href="{{ url('/member/deal/'.\App\Deal::DEAL_FIRST_REPUBLIC_PLOC_SLUG.'/hand-off') }}" class="btn-voila cta mt-5">See your rate</a>

                <p class="mt-2"><a class="btn pill-radius py-3 btn-outline-primary" href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/alternate-options') }}">View alternative refinance options</a></p>
            </div>
        </div>
    </div>

    <div class="py-5"></div>

    <first-republic-calculator></first-republic-calculator>

    <div class="py-5"></div>

    @include('member.deal-partials.leveredge-rewards-section' , [
        'rewardText' => 'We give you $400 when you open the First Republic Personal Line of Credit via Juno.',
        'rewardsCalculated' => 'We’re giving you $400 out of the fee that First Republic pays Juno. This is separate and in addition to the $400 First Republic offers you for being a Juno Member',
        'useWhiteBackground' => true,
    ])

{{--    <div class="jumbotron bg-translucent-green my-0">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <p><a href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/alternate-options') }}">See additional options for you</a></p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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

@endsection

@include('member.deal.first-republic-refinance._disclosures')

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
