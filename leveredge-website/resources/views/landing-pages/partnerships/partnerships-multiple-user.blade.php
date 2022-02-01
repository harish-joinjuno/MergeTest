@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@section('content')
    @include('landing-pages.partnerships._partnership-header', [
        'partner' => $partner,
    ])

    <div class="container narrow my-5 py-5">
        <h1 class="text-center">
            We use group buying power to negotiate better student loan rates.
        </h1>

        @include('landing-pages.partials.home._home-cta', [
            'description' => 'Rates negotiated exclusively for members start at 1.24% APR
            <sup class="foot-note-marker">1</sup>'
        ])
    </div>

    <div class="container-fluid bg-light py-5">
        <div class="container my-5 px-0">
            <h4 class="text-center underlined mb-5">
                Deals we think you'd love
            </h4>
            <div class="row align-items-stretch py-5">
                <div class="col-12 col-md-6 d-flex flex-column mb-4">
                    <div class="shadow-sm p-3 bg-white rounded">
                        <h5 class="font-weight-bold off-black">Undergraduate loans</h5>
                        <p style="min-height:5em;">
                            For undergrads who’ve hit the caps on Federally Held Student Loans. Our deal takes off 1% on
                            interest (ex. 5% ->4%) & has no origination fee.
                        </p>
                        <a
                            href="{{ url('/loans/undergraduate') }}"
                            class="btn btn-secondary rates-button px-5 font-weight-bold"
                        >
                            View Details
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex flex-column mb-4">
                    <div class="shadow-sm p-3 bg-white rounded">
                        <h5 class="font-weight-bold off-black">Graduate loans</h5>
                        <p style="min-height:5em;">
                            A good alternative to Federal Loans for people with good credit or a co-signer.
                            All graduate deals feature cashback rewards.
                        </p>
                        <a
                            href="{{ url('/loans/graduate') }}"
                            class="btn btn-secondary rates-button px-5 font-weight-bold"
                        >
                            View Details
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex flex-column mb-4">
                    <div class="shadow-sm p-3 bg-white rounded">
                        <h5 class="font-weight-bold off-black">Refinance loans</h5>
                        <p style="min-height:5em;">
                            Lower your existing student loans by converting them into a new loan with a better interest rate. Best for people with a steady income. Depending on borrower location & occupation,
                            we’ll recommend the best option. Most deals feature cashback or a rate reduction.
                        </p>
                        <a
                            href="{{ url('/loans/refinance') }}"
                            class="btn btn-secondary rates-button px-5 font-weight-bold"
                        >
                            View Details
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex flex-column mb-4">
                    <div class="shadow-sm p-3 bg-white rounded">
                        <h5 class="font-weight-bold off-black">International health insurance</h5>
                        <p style="min-height:5em;">
                            For those looking for a cheaper alternative to signing on with a university’s
                            mandatory insurance plan.
                        </p>
                        <a
                            href="{{ url('/insurance/international-health') }}"
                            class="btn btn-secondary rates-button px-5 font-weight-bold"
                        >
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('landing-pages.partials._press-banner')
@endsection
