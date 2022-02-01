@extends('template.public')

@section('content')
    <div class="container-fluid py-5">
        <div class="container narrow text-center my-5">
            <h2 class="mb-5">Laurel Road offers competitive rates for refinancing your student loans.</h2>
            <h5 class="mb-5">
                As a Juno member, Laurel Road will offer you a
                <span class="text-brand-green">rate reduction of 0.25%.</span> In addition, you may be able to pay
                back your medical school loans at only
                <span class="text-brand-green">$100 per month</span> while in residency or fellowship.
                <a target="_blank" href="{{ asset('img/laurel-road-refi-disclosure-for-100-per-month.png') }}">*</a>
            </h5>
            <a
                target="_blank"
                rel="noreferrer"
                href="{{ url('/fast-flow/laurel-road/') }}"
                class="btn bg-secondary rates-button rounded-pill px-5 font-weight-bold"
            >
                Check my rate
            </a>
        </div>
    </div>

    @if(!empty($rates))
        @include('landing-pages.partials._rates-table', [
            'title' => 'Laurel Road Refinance Rates',
            'description' => $rates->description,
            'ctaLink' => $rates->cta_link,
            'ctaText' => $rates->cta_text,
            'rates' => $rates,
            'termTitle' => $rates->term_title,
            'aprTitle' => $rates->apr_title
        ])
    @endif

    @include('landing-pages.partials._benefits-of-the-deal', [
        'benefitsOfTheDealHeading' => 'Features',
        'benefits' => [
            'No fees for origination, disbursement, prepayment',
            '0.25% Auto Pay discount <a target="_blank"  href="' .
            asset('img/laurel-road-refi-disclosure-for-100-per-month.png')  . '" class="text-underline">*</a>',
            'Pay back your medical school loans at only $100 per month while in residency or fellowship before
            beginning your standard repayment term <a target="_blank"  href="' .
            asset('img/laurel-road-refi-disclosure-for-100-per-month.png')  . '" class="text-underline">*</a>',
        ]
    ])

    @include('landing-pages.fast-flow.partials._trust-elements', [
        'hideForm' => true,
    ])

    @include('landing-pages.partials._faqs')
@endsection
