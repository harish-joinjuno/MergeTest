@extends('template.public')

@php

    $small_testimonials=[

        "The deal I was offered blew all of my other options completely out of the water, and is saving me thousands of dollars",

        "I initially went with SunTrust ... I sadly got a 6.7 rate ... I just got my order from Juno and it's 4.475!",

        "I've applied for over 20 loans last year, and this one gave me the best interest rate and flexibility on repayment terms.",
    ];

@endphp

@push('header-scripts')
    <link href="{{mix('mix/css/app.css')}}" rel="stylesheet">

    <style>
        #refinance-domestic-group .font-size-40{
            font-size: 40px;
        }

        #refinance-domestic-group .font-size-36{
            font-size: 36px;
        }

        #refinance-domestic-group .font-size-24{
            font-size: 24px;
            text-transform: none;
        }

        #refinance-domestic-group a{
            color: #0c2e8a;
            text-decoration: underline;
        }

        #refinance-domestic-group .list-of-features i{
            font-size: 16px;
        }

        #refinance-domestic-group p :not(#welcome-logo-strip p){
            color: #4a4a4a;
            line-height: 30px;
        }

        #refinance-domestic-group #questions p{
            font-size: 18px;
            line-height: 24px;
        }

        #refinance-domestic-group #negotiation-timeline img{
            height: 157px;
            width: 157px;

            margin-bottom: 36px;
        }

        #refinance-domestic-group #negotiation-timeline h2{
            margin-bottom: 18px;
            font-size: 24px;
        }

        #refinance-domestic-group #negotiation-timeline p{
            margin-bottom: 36px;
            line-height: 20px;
            font-size: 14px;
        }

        #refinance-domestic-group #negotiation-timeline .btn{
            padding: 18px 42px;
            font-size: 16px;
            text-transform: uppercase;
            border-radius: 5px;
        }

        #refinance-domestic-group #negotiation-timeline .card.active{
            border: 3px solid #3B61E3;
            box-shadow: 0 4px 40px #b5b5b5;
        }

        #refinance-domestic-group #negotiation-timeline .card{
            border: 1px solid #DCDCDC;
            box-shadow: 0 0 10px rgba(83,96,138,0.15);
        }

        #refinance-domestic-group #testimonials h2{
            font-size: 40px;
            text-transform: none;
        }


        #refinance-domestic-group #testimonials .quote-image{
            height: 70px;
            margin-left: auto;
            margin-right: auto;
        }

    </style>
@endpush


@section('content')

    <div id="safeApp">

{{--        @guest--}}
{{--        <countdown-timer--}}
{{--            :countdown-to-string="'2020/04/01'"--}}
{{--            :show-day="true"--}}
{{--            :show-hour="true"--}}
{{--            :show-minute="true"--}}
{{--            :show-second="true"--}}
{{--        >--}}

{{--            <template v-slot:message>--}}
{{--                left to join the Refinance Group. <a class="branded-link" href="https://app.joinjuno.com/register">Join Now</a>--}}
{{--            </template>--}}

{{--        </countdown-timer>--}}
{{--        @endguest--}}



        <div id="refinance-domestic-group">

            @yield('content-above-hero')

            @guest
                <div class="jumbotron bg-white mb-0">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center">
                                <h1 class="font-size-36">Need to Refinance your Student loans? Sign up today.</h1>
                                <h2 class="font-size-24 mt-4">
                                    We use group buying power to negotiate refinancing rates on student loans.
                                    Keep your options open, and make an informed decision.
                                </h2>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-12 col-md-8 col-lg-6 text-center list-of-features">
                                @include('common.get-started-with-email-form')

                                <div class="mt-5">
                                    <p class="mb-2">
                                        <i class="fas fa-check brand-color"></i> Free for Borrowers
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-check brand-color"></i> It takes < 1 minute to join
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-check brand-color"></i> We don't run a credit check
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="container py-0 mt--3 mb-4">
                <div class="row justify-content-center mt-5">
                    <div class="col-12 col-lg-8 text-center">
                        <p>
                            Born out of the Harvard Innovation Lab, our initiative has already saved
                            families more than 26 million dollars. You can
                            <a href="{{ url('https://joinjuno.com/our-story/') }}">learn more about our
                            founders' story here</a>.
                        </p>
                    </div>
                </div>
            </div>

                <div class="jumbotron mt-0 mb-0 pt-3 pt-md-0 pb-3 pb-md-0" id="welcome-logo-strip">
                    <div class="container pt-0 pb-0 mt-0 mb-0">
                        <div class="row justify-content-center">
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
                                                <img src="{{ $press[1] }}" class="img-fluid" style="max-height: 24px; margin-left: auto; margin-right: auto;">
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


                <div class="pt-3 pb-3"></div>
                <div class="pt-3 pb-3"></div>
            @endguest

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="font-size-40 text-center mb-5">
                            Why Refinance?
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 my-auto">
                        <p class="mt-3 font-size-24">
                            <strong>
                                Refinancing your student loan could lower your interest rate.
                            </strong>
                        </p>
                        <p class="mt-3" style="font-size: 16px; line-height: 24px;">
                            When you graduate and get a job, lenders believe you are more likely to pay back your loan.
                            As a result, you can refinance all your previous student loans at a new, lower rate.
                        </p>
                    </div>
                    <div class="col-md-6 col-12">
                        <img class="img-fluid" src="{{ url('/img/students-looking-at-rates.png') }}">
                    </div>
                </div>
            </div>

            <div class="pt-3 pb-3"></div>
            <hr class="mb-5">
            <div class="pt-3 pb-3"></div>

            @auth
                @if(user()->currentReferralProgramUser())
                <div id="referral-program-section">
                    @include('member.referral-program.partials.referral-program-embed',['referralProgramUser' => user()->currentReferralProgramUser()])
                </div>

                <div class="pt-3 pb-3"></div>
                <hr class="mb-5">
                <div class="pt-3 pb-3"></div>
                @endif
            @endauth

            @include('member.partials.refinance-domestic-partials.negotiation-timeline')

            <div class="pt-3 pb-3"></div>
            <hr class="mb-5">

            <div class="jumbotron my-0 py-0 bg-transparent">
                <section id="testimonials" class="">
                    <div class="container">
                        <div class="row mb-5">
                            <div class="col-12 text-center">
                                <h2>Reviews</h2>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-5">
                            <div class="col-12 col-lg-8 text-center">
                                <div class="embed-responsive embed-responsive-16by9 mt-4">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/dxg-wPZgu5M?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($small_testimonials as $testimonial)
                                <div class="col-lg-4 col-12">
                                    <div class="card testimonial-card negotiated-deal-shadow mt-4">
                                        <div class="card-body text-center">

                                            <img src="{{ url('/img/icons/testimonial-quote-icon.png') }}" height="70px" class="mt-4 quote-image">

                                            <p class="card-text mt-5">{{ $testimonial }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-12 mt-5 text-center">
                                <a class="link" href="{{ url('/reviews') }}">READ ALL REVIEWS</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="pt-3 pb-3"></div>
            <hr class="mb-5">
            <div class="pt-3 pb-3"></div>

            @include('member.partials.frequently-asked-questions',['negotiationGroup' => $negotiationGroup])

            <div class="pt-3 pb-3"></div>
            <hr class="mb-5">
            <div class="pt-3 pb-3"></div>

            <div class="container" id="questions">
                <div class="row mb-5">
                    <div class="col-12">
                        <h1 class="font-size-40 text-center">
                            Got Questions? We Got Answers.
                        </h1>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <p class="text-center"><strong>Ask Nikhil</strong></p>

                        <p class="mt-3">
                            We understand that student loans and our negotiation process can be complicated. Please ask us any
                            and all questions you have.
                        </p>

                        <p class="mt-3">
                            As a founder of Juno, I check
                            <a class="link" href="mailto:support@joinjuno.com">support@joinjuno.com</a>
                            more frequently than my personal email.
                        </p>
                    </div>
                </div>
            </div>



        </div>



    </div>


@endsection


{{--<script>--}}
{{--    import CountdownTimer from "../js/components/common/countdown-timer";--}}
{{--    export default {--}}
{{--        components: {CountdownTimer}--}}
{{--    }--}}
{{--</script>--}}
