@extends('template.public')

@push('header-scripts')
    <style>
        .border-thick {
            border:4px solid transparent;
        }
    </style>
@endpush

@section('content')
    <div class="container py-5">
        <h1 class="text-center off-black mb-3">Negotiated just for you</h1>
    </div>
    <div class="container-fluid bg-light-green py-5">
        <div class="container px-0">
            <div class="row">
                <div class="col-12 col-lg-6 d-flex flex-column text-center mb-4">
                    <div class="col-12 bg-white border-primary border-thick rounded px-0">
                        <div class="px-3">
                            <h2 class="off-black py-3">
                                Refinance with Earnest
                            </h2>
                            <h6>Fixed rates starting at 2.98% APR</h6>
                            <h6>Variable rates starting at 1.99% APR</h6>
                        </div>
                        <hr>
                        <ul class="text-left list-unstyled px-3">
                            <li>
                                <i class="primary fad fa-check pr-2"></i>
                                Only a
                                <u data-toggle="tooltip" title="does not impact your credit score">soft credit check</u>
                                is required to see your rates.
                            </li>
                            <li>
                                <i class="primary fad fa-check pr-2"></i>
                                For being a Juno member, you'll receive cash back based on the amount
                                you refinance.
                            </li>
                        </ul>
                        <table class="table table-bordered table-striped mb-0 small text-center">
                            <thead>
                            <tr class="row mx-0 font-weight-bold">
                                <td class="col-3 px-0">Loan Amount</td>
                                <td class="col-3 px-0">Earnest<br>Reward<sup class="foot-note-marker">7</sup></td>
                                <td class="col-3 px-0">Juno<br>Reward</td>
                                <td class="col-3 px-0">Total</td>
                            </tr>
                            </thead>

                            <tbody>
                            <tr class="row mx-0">
                                <td class="col-3">Up to $75K</td>
                                <td class="col-3">$500</td>
                                <td class="col-3">$0</td>
                                <td class="col-3">$500</td>
                            </tr>

                            <tr class="row mx-0">
                                <td class="col-3">$75K to 100K</td>
                                <td class="col-3">$500</td>
                                <td class="col-3">$250</td>
                                <td class="col-3">$750</td>
                            </tr>

                            <tr class="row mx-0">
                                <td class="col-3">Above $100K</td>
                                <td class="col-3">$500</td>
                                <td class="col-3">$500</td>
                                <td class="col-3">$1000</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="p-3">
                            <a
                                href="{{ url('/fast-flow/earnest/') }}"
                                class="btn btn-primary text-white"
                            >
                                Check my rate
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 d-flex flex-column text-center mb-4">
                    <div class="col-12 d-flex flex-column bg-white border-primary border-thick rounded px-0">
                        <div class="px-3">
                            <h2 class="off-black py-3">
                                Refinance with Splash Financial
                            </h2>
                            <h6>Fixed rates starting at 2.88% APR</h6>
                            <h6>Variable rates starting at 1.98% APR</h6>
                        </div>
                        <hr>
                        <ul class="text-left list-unstyled px-3">
                            <li>
                                <i class="primary fad fa-check pr-2"></i>
                                Only a
                                <u data-toggle="tooltip" title="does not impact your credit score">soft credit check</u>
                                is required to see your rates.
                            </li>
                            <li>
                                <i class="primary fad fa-check pr-2"></i>
                                For being a Juno member and refinancing a loan above $50k,
                                you’ll receive $600 total cash back.
                            </li>
                        </ul>
                        <div class="spacer h-100"></div>
                        <hr>
                        <div class="p-3">
                            <a
                                href="{{ url('/fast-flow/splash/') }}"
                                class="btn btn-primary text-white"
                            >
                                Check my rate
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('landing-pages.fast-flow.partials._trust-elements', [
        'hideForm' => true,
    ])

    @include('landing-pages.partials._faqs')
@endsection
