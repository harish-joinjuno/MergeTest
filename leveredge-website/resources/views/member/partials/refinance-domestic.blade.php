@php
    $negotiationGroup = $negotiationGroupUser->negotiationGroup;
@endphp

@push('header-scripts')
    <style>
        #refinance-domestic-group .font-size-40{
            font-size: 40px;
        }

        #refinance-domestic-group p {
            color: #4a4a4a;
            font-size: 24px;
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

    </style>
@endpush


<div id="refinance-domestic-group">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center font-size-40">
                    Grow the group to 2,000 students by the end of May
                </h1>
                <p class="text-center mt-3">
                    The larger the group, the more bargaining power we have and the better rates we can negotiate.
                </p>
            </div>
            <div class="col-md-8">
                <div class="mt-5">

                    <div
                        class="tw_w-full tw_mt-1 tw_shadow tw_w-full tw_h-12 bg-grey">
                        <div
                            class="bg-secondary-green tw_flex tw_flex-row tw_h-12 tw_items-center tw_justify-center tw_leading-none tw_text-center tw_text-white"
                            style="width: {{( 1500 / 2000 * 100)}}%">
                            {{ "~1,500" }} members in the group
                        </div>
                    </div>
                    <div
                        class="tw_w-full tw_pl-2 tw_text-right tw_text-xl tw_text-gray-600">
                        Goal of 2,000
                    </div>
                </div>
            </div>
        </div>
        @guest
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 text-center">
                    @include('common.get-started-with-email-form')
                </div>
            </div>
        @endguest
    </div>

    <div class="pt-3 pb-3"></div>
    <hr class="mb-5">
    <div class="pt-3 pb-3"></div>

    <div id="referral-program-section">
        @include('member.referral-program.partials.referral-program-embed',['referralProgramUser' => user()->currentReferralProgramUser()])
    </div>

    <div class="pt-3 pb-3"></div>
    <hr class="mb-5">
    <div class="pt-3 pb-3"></div>

</div>

