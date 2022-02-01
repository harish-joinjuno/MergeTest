@push('header-scripts')
    <style>
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

    </style>
@endpush

<div id="general-group-20-21">


    @include('member.partials.general-group-20-21-partials.progress-bar', ['negotiationGroup' => $negotiationGroupUser->negotiationGroup])

    <div class="pt-3 pb-3"></div>
    <hr class="mb-5">
    <div class="pt-3 pb-3"></div>

    <div id="referral-program-section">
        @include('member.referral-program.partials.referral-program-embed',['referralProgramUser' => user()->currentReferralProgramUser()])
    </div>

    <div class="pt-3 pb-3"></div>
    <hr class="mb-5">
    <div class="pt-3 pb-3"></div>

    @include('member.partials.general-group-20-21-partials.negotiation-timeline')

    <div class="pt-3 pb-3"></div>
    <hr class="mb-5">
    <div class="pt-3 pb-3"></div>

    <div class="container" id="questions">
        <div class="row mb-5">
            <div class="col-12">
                <h1 class="font-size-40 text-center">
                    Questions?
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
