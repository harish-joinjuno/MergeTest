@extends('landing-pages.landing-page-layout', [
    'pageHeading' => 'We use group buying power to negotiate better
    <u class="text-secondary"><span class="js-text-animation off-black"></span></u>',
    'headingColor' => 'text-primary custom-header',
    'callToActionURL' => '/register',
    'callToActionText' => 'Access the Deal',
    'headingBackgroundImage' => '',
    'centerHeading' => true,
    'hideForm' => true,
    'hideBottom' => true,
    'narrowHeading' => true,
    'alertBanner' => 'LeverEdge is now Juno! <a class="text-white" href="/leveredge-is-now-juno"><u>Learn Why</u></a>',
    'customBannerClasses' => 'pb-5 mt-0'
])

@section('customCTA')
    @include('landing-pages.partials.home._home-cta', [
        'description' => 'Rates negotiated exclusively for members start at 1.04% APR
        <sup class="foot-note-marker">1</sup>'
    ])
@endsection

@push('header-scripts')
    <style>
        .hover-raise {
            transition:all .2s ease-in-out;
            transform:scale(1);
        }
        .hover-raise:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            transform:scale(1.05);
        }
        .custom-header {
            min-height:7.5em;
            margin:0!important;
        }
        @media screen and (min-width:768px) {
            .custom-header {
                min-height:4.5em;
            }
        }
    </style>
@endpush

@push('footer-scripts')
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
    <script>
        $(document).ready(function () {
            new Typed('.js-text-animation', {
                strings: [
                    'undergrad student loans.',
                    'MBA student loans.',
                    'grad student loans.',
                    'student loan refinancing.',
                    'international health insurance.',
                    'auto refinancing.'
                ],
                typeSpeed: 60,
                loop: true,
                backSpeed: 30,
                backDelay: 2500
            });
        });
    </script>
@endpush

@section('pre-body')
    <div class="conatiner-fluid pb-5">
        <div class="container narrow mb-5 pb-5">
            <div class="row flex-wrap text-center">
                <div class="col-6 col-sm-4 p-1">
                    <a
                        href="{{ url('/group/graduate') }}"
                        class="hover-raise d-flex flex-column align-items-center text-primary border p-3 rounded-lg shadow-sm h-100"
                    >
                        <img src="{{ asset('/img/home-icons/graduate-loans.png') }}" class="img-fluid w-50" alt="Graduate Loans">
                         Graduate<br>Loans
                    </a>
                </div>
                <div class="col-6 col-sm-4 p-1">
                    <a
                        href="{{ url('/group/undergraduate') }}"
                        class="hover-raise d-flex flex-column align-items-center text-primary border p-3 rounded-lg shadow-sm h-100"
                    >
                        <img src="{{ asset('/img/home-icons/undergraduate-loans.png') }}" class="img-fluid w-50" alt="Undergraduate Loans">
                        Undergraduate<br>Loans
                    </a>
                </div>
                <div class="col-6 col-sm-4 p-1">
                    <a
                        href="{{ url('/loans/refinance') }}"
                        class="hover-raise d-flex flex-column align-items-center text-primary border p-3 rounded-lg shadow-sm h-100"
                    >
                        <img src="{{ asset('/img/home-icons/lower-existing-student-loans.png') }}" class="img-fluid w-50" alt="Lower Existing Student Loans">
                        Lower Existing<br>Student Loans
                    </a>
                </div>
                <div class="col-6 col-sm-4 p-1">
                    <a
                        href="{{ url('/insurance/international-health') }}"
                        class="hover-raise d-flex flex-column align-items-center text-primary border p-3 rounded-lg shadow-sm h-100"
                    >
                        <img src="{{ asset('/img/home-icons/health-insurance.png') }}" class="img-fluid w-50" alt="International Health Insurance">
                        International Health<br>Insurance
                    </a>
                </div>
                <div class="col-6 col-sm-4 p-1">
                    <a
                        href="{{ url('/loans/auto-refinance') }}"
                        class="hover-raise d-flex flex-column align-items-center text-primary border p-3 rounded-lg shadow-sm h-100"
                    >
                        <img src="{{ asset('/img/home-icons/auto-refinance.png') }}" class="img-fluid w-50" alt="Auto Loan Refinancing">
                        Auto Loan<br>Refinancing
                    </a>
                </div>
                <div class="col-6 col-sm-4 p-1">
                    <a
                        href="{{ url('/loans/international-refinance') }}"
                        class="hover-raise d-flex flex-column align-items-center text-primary border p-3 rounded-lg shadow-sm h-100"
                    >
                        <img src="{{ asset('/img/home-icons/international-refinance.png') }}" class="img-fluid w-50" alt="International Refinance">
                        International<br>Refinance
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5 mt-lg-0 pt-5 pt-lg-0 px-0">
    <div class="container home-header-image pt-5 pt-lg-0">
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('/img/welcome-hero.png') }}" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="bg-light-green py-5 mt-n5"></div>
</div>
@endsection

@section('page-body')
{{--@include('landing-pages.partials.home._deal-cards')--}}

@include('landing-pages.partials.home._how-it-works')

@if(isset($displayReferralProgramButton) && $displayReferralProgramButton)
    @if(empty($hideReferralProgramButton))
    <div
        id="#referrals"
        class="container-fluid py-5 px-sm-0 bg-light"
    >
        <div class="container my-5 px-0">
            @include('landing-pages.partials.home._cashback-card')
        </div>
    </div>
    @endif
@endif

@include('landing-pages.partials.home._join-now-video', [
    'joinNow' => 'Join a negotiation group for free',
    'userType' => 'Members',
])

@include('landing-pages.partials.home._why-juno')
@endsection

@push('custom-disclaimers')
<p class="text-footer-disclaimer">
    1 - APR Rates shown are effective as of 7/1/2020 to the best of our knowledge. For the most up to
    date rates, we recommend contacting our partners. APRs include discounts such as autopay discounts and/or
    relationship discounts. If approved for a loan, the rates and terms offered will depend on things like
    creditworthiness, the loan term, and other factors. Not all applicants qualify for the lowest rate.
    If approved for a loan, to qualify for the lowest rate, you must have a responsible financial history and
    meet other conditions. Each lender reserves the right to change interest rates at any time without notice.
</p>
@endpush
