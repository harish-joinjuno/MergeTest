@extends('landing-pages.landing-page-layout', [
    'pageHeading' => 'We use group buying power to negotiate better student loan refinancing rates',
    'headingColor' => 'text-primary custom-header',
    'callToActionURL' => '/register',
    'callToActionText' => 'Access the Deal',
    'headingBackgroundImage' => '',
    'centerHeading' => true,
    'hideForm' => true,
    'narrowHeading' => true,
    'alertBanner' => 'LeverEdge is now Juno! <a class="text-white" href="/leveredge-is-now-juno"><u>Learn Why</u></a>',
])

@section('customCTA')

    @include('landing-pages.partials.home._home-cta')
@endsection

@section('pre-body')
    <div class="container-fluid px-0">
        <div class="container home-header-image">
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
    @include('landing-pages.partials.home._deal-cards')

    @include('landing-pages.partials.home._how-it-works', [
        'customDescription' => 'We gather large groups of students and professionals and get lenders to compete for
        our business',
        'stepOne' => 'Sign up for free and tell us a little bit about yourself and the type of loan you need.',
    ])

    @include('landing-pages.partials.home._join-now-video', [
        'joinNow' => 'Join a negotiation group today',
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

