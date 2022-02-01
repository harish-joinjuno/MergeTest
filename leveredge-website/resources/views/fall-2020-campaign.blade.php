@extends('template.public')


@push('header-scripts')

    <link href="{{mix('mix/css/app.css')}}" rel="stylesheet">

    <style>
        #general-group-20-21 .container{
            padding-top: 30px;
            padding-bottom: 30px;
        }

        #general-group-20-21 .font-size-40{
            font-size: 40px;
        }

        #general-group-20-21 p {
            color: #4a4a4a;
            font-size: 24px;
            line-height: 30px;
        }

        #general-group-20-21 #questions p{
            font-size: 18px;
            line-height: 24px;
        }

        #general-group-20-21 #negotiation-timeline img{
            height: 157px;
            width: 157px;

            margin-bottom: 36px;
        }

        #general-group-20-21 #negotiation-timeline h2{
            margin-bottom: 18px;
            font-size: 24px;
        }

        #general-group-20-21 #negotiation-timeline p{
            margin-bottom: 36px;
            line-height: 20px;
            font-size: 14px;
        }

        #general-group-20-21 #negotiation-timeline .btn{
            padding: 18px 42px;
            font-size: 16px;
            text-transform: uppercase;
            border-radius: 5px;
        }

        #general-group-20-21 #negotiation-timeline .card.active{
            border: 3px solid #3B61E3;
            box-shadow: 0 4px 40px #b5b5b5;
        }

        #general-group-20-21 #negotiation-timeline .card{
            border: 1px solid #DCDCDC;
            box-shadow: 0 0 10px rgba(83,96,138,0.15);
        }

        #general-group-20-21 p{
            font-size: 16px;
        }

        #general-group-20-21 #old-deal-calculator h3{
            font-size: 21px;
            text-transform: uppercase;
        }

        #general-group-20-21 #old-deal-calculator #lr_savings{
            font-size: 40px;
        }

    </style>
@endpush


@section('content')

    <div id="safeApp">

{{--        <countdown-timer--}}
{{--            :countdown-to-string="'2020/04/01'"--}}
{{--            :show-day="true"--}}
{{--            :show-hour="true"--}}
{{--            :show-minute="true"--}}
{{--            :show-second="true"--}}
{{--        >--}}
{{--            <template v-slot:message>--}}
{{--                left to join the Fall 2020 Negotiation Group. <a class="branded-link" href="https://app.joinjuno.com/register">Join Now</a>--}}
{{--            </template>--}}
{{--        </countdown-timer>--}}

        <div class="jumbotron bg-brand pt-0 pb-0">
            <div class="container text-light py-2">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8 text-center">
                        <p class="text-light">
                            COVID-19 Update: No deadline for students to sign up. <a class="text-light text-underline" href="{{ url('https://joinjuno.com/covid-no-deadline/') }}">Learn more</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="general-group-20-21" class="mt-5">

            @guest
                <div class="jumbotron bg-white mb-0">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center">
                                <h1 class="font-size-40">Need a Loan for Fall 2020? Sign up Today</h1>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-12 col-md-8 col-lg-6 text-center">
                                @include('common.get-started-with-email-form')
                            </div>
                        </div>
                    </div>
                </div>


            <div class="pt-3 pb-3"></div>
            <hr class="mb-5">
            <div class="pt-3 pb-3"></div>
            @endguest

            @include('member.partials.general-group-20-21-partials.progress-bar', ['negotiationGroup' => $negotiationGroup])

            <div class="pt-3 pb-3"></div>
            <hr class="mb-5">
            <div class="pt-3 pb-3"></div>

            @include('member.partials.general-group-20-21-partials.negotiation-timeline')

            <div class="pt-3 pb-3"></div>
            <hr class="mb-5">
            <div class="pt-3 pb-3"></div>

            <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent" id="old-deal-calculator">
                <div class="container py-0 my-0">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="font-size-40 text-center">Estimated Savings Compared to Federal Loans</h1>
                            <h2 class="text-center">Based on 2019 Deal for Select Graduate Programs</h2>
                        </div>
                    </div>
                </div>
                @include('in-school.negotiated_deal.federal-loan-vs-laurel-road-calculator',['use_alternate_introduction' => true])
                <div class="container py-0 my-0">
                    <div class="row">
                        <div class="col-12">
                            <p>Please note that the calculator is based on the deal we negotiated for Juno Members
                                at select graduate programs interested in a loan for Fall 2019. We cannot guarantee
                                that we will be able to negotiate a similar offer for students seeking a loan in Fall
                                2020. Of course, we will try our best to meet or exceed your expectations.</p>
                        </div>
                    </div>
                </div>

            </div>

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

            <div class="pt-3 pb-3"></div>
            <div class="pt-3 pb-3"></div>

        </div>

    </div>


@endsection
{{--<script>--}}
{{--    import CountdownTimer from "../js/components/common/countdown-timer";--}}
{{--    export default {--}}
{{--        components: {CountdownTimer}--}}
{{--    }--}}
{{--</script>--}}

@push('footer-scripts')



    <script src="{{ url('/lib/cleave/cleave.min.js') }}"></script>
    <script>

        var cleave_2 = new Cleave('#sl_loan_amount', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });



        function PMT(ir, np, pv, fv, type) {
            /*
             * ir   - interest rate per month
             * np   - number of periods (months)
             * pv   - present value
             * fv   - future value
             * type - when the payments are due:
             *        0: end of the period, e.g. end of month (default)
             *        1: beginning of period
             */
            var pmt, pvif;

            fv || (fv = 0);
            type || (type = 0);

            if (ir === 0)
                return -(pv + fv)/np;

            pvif = Math.pow(1 + ir, np);
            pmt = - ir * pv * (pvif + fv) / (pvif - 1);

            if (type === 1)
                pmt /= (1 + ir);

            return pmt;
        }


        function removeCommas(str) {
            while (str.search(",") >= 0) {
                str = (str + "").replace(',', '');
            }
            return str;
        }

    </script>


    @include('in-school.negotiated_deal.federal-loan-vs-laurel-road-calculator-js')

@endpush
