@extends('member.refinance-medical-in-fr-cities.recommended-base')

@push('header-scripts')
    <link rel="stylesheet" href="{{ asset('mix/css/pages/split-recommended.css') }}">
@endpush

@section('deal-content')

    <!--- We want to show primary option coming soon (Laurel Road) and Earnest as a secondary Option --->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center off-black mb-3">Negotiated just for you</h1>
                <p class="text-center primary"><a class="primary fw-600 fw-600" href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiation_group_id . '/refinance-deal-recommendation-questions') }}"><u>Change my answers</u></a></p>
            </div>
        </div>
    </div>

    <div class="jumbotron bg-translucent-green pt-1 pt-md-5 mt-0 mb-0 px-0 px-md-3">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-12 px-0 px-md-3">
                    <table class="table table-bordered table-split-recommended border-secondary-green font-weight-bold">
                        <thead>
                        <tr>
                            <td></td>
                            <td>
                                <h1 class="text-center off-black">First Republic</h1>
                                <h3 class="text-center product-sub-heading font-weight-bold">Personal Line of Credit <sup class="foot-note-marker">1</sup></h3>
                                <h3 class="text-center secondary-green apr-sub-heading font-weight-bold">APR between 2.25% - 3.50% <sup class="foot-note-marker">3</sup></h3>
                            </td>
                            <td>
                                <h1 class="text-center off-black">Laurel Road</h1>
                                <h3 class="text-center product-sub-heading font-weight-bold">Student Loan Refinancing</h3>
                                <h3 class="text-center secondary-green apr-sub-heading font-weight-bold">APR between 1.74% - 6.18% <sup class="foot-note-marker">4</sup></h3>
                            </td>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="py-4 px-1 px-md-3 off-black"><div><p>Juno <br class="d-block d-md-none"/> benefit</p></div></td>
                            <td class="py-4 px-3">For being a Juno member, you’ll receive up to $800 cash back. <sup class="foot-note-marker">2</sup></td>
                            <td class="py-4 px-3">As a Juno Member, you’ll receive a 0.25% rate reduction from the lender.</td>
                        </tr>

                        <tr>
                            <td class="py-4 px-1 px-md-3 off-black"><div><p>Initial <br class="d-block d-md-none"/> Payments</p></div></td>
                            <td class="py-4 px-3">Interest Only payments during  the first 2 years</td>
                            <td class="py-4 px-3">$100 per month payments during residency or fellowship <a href="{{ asset('img/laurel-road-refi-disclosure-for-100-per-month.png') }}">*</a></td>
                        </tr>

                        <tr>
                            <td class="py-4 px-1 px-md-3 off-black"><div><p>Maximum <br> Loan Size</p></div></td>
                            <td class="py-4 px-3">$350,000 (See FAQ for details)</td>
                            <td class="py-4 px-3">No limit</td>
                        </tr>

                        <tr>
                            <td class="py-4 px-1 px-md-3 off-black"><div><p>Use <br class="d-block d-md-none"/> of Funds</p></div></td>
                            <td class="py-4 px-3">Flexible - Refinance student loans, buy or refinance a car or pay for home improvements, etc.</td>
                            <td class="py-4 px-3">Refinance your student loans</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-1 px-md-3 off-black"><div><p>Loan <br class="d-block d-md-none"/> Fees</p></div></td>
                            <td class="py-4 px-3">
                                No origination fee<br>
                                No prepayment penalty
                            </td>
                            <td class="py-4 px-3">
                                No origination fee<br>
                                No prepayment penalty
                            </td>
                        </tr>

                        <tr>
                            <td class="py-4 px-1 px-md-3 off-black"><div><p>Tax <br class="d-block d-md-none"/> Benefit</p></div></td>
                            <td class="py-4 px-3">No tax benefit</td>
                            <td class="py-4 px-3">Up to $2,500 Interest Deduction on Federal Taxes <sup class="foot-note-marker">**</sup></td>
                        </tr>

                        <tr>
                            <td class="py-4 px-1 px-md-3 off-black"><div><p>Loan <br class="d-block d-md-none"/> Term</p></div></td>
                            <td class="py-4 px-3">7, 10 or 15 years</td>
                            <td class="py-4 px-3">5, 7, 10, 15 or 20 years</td>
                        </tr>

                        <tr>
                            <td class="py-5 px-3"></td>
                            <td class="py-4 py-md-5 px-1 px-md-3 text-center">
                                <p class="mb-2 mb-md-0"><a href="{{ url('/member/deal/'.\App\Deal::DEAL_FIRST_REPUBLIC_PLOC_SLUG.'/hand-off') }}" class="btn btn-primary rounded-pill px-4 px-md-5">Check my <br class="d-block d-md-none"/> rate</a></p>
                                <p><a href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiation_group_id . '/first-republic-refinance-deal') }}" class="btn btn-link secondary-green fw-600 px-0"><u>View details <br class="d-block d-md-none"/> page</u></a></p>
                            </td>
                            <td class="py-4 py-md-5 px-1 px-md-3 text-center">
                                <p class="mb-2 mb-md-0"><a href="{{ url('/member/deal/'.\App\Deal::DEAL_LAUREL_ROAD_REFINANCE_SLUG.'/hand-off') }}" class="btn btn-primary rounded-pill px-4 px-md-5">Check my <br class="d-block d-md-none"/> rate</a></p>
                                <p><a href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiation_group_id . '/laurel-road-deal') }}" class="btn btn-link secondary-green fw-600 px-0"><u>View details <br class="d-block d-md-none"/> page</u></a></p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="py-2 py-lg-4"></div>

    <div class="jumbotron bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <p class="fw-600">Common Question:</p>
                    <h2 class="off-black">What’s the difference between a line of credit and student loan refinancing?</h2>
                    <div class="row mt-4 mb-4 mb-lg-0">
                        <div class="col-10">
                            <img src="{{ asset('img/plane-fall-2020.png') }}" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <p>
                        A student loan refinancing allows you to take a new loan that pays off all your existing
                        student loans. This new loan may only be used for paying off your existing student loans.
                    </p>
                    <p>
                        A line of credit allows you to draw on the loan multiple times, offering the ability to draw
                        on the funds available once principal on the funds drawn are repaid. You can use the funds to
                        refinance your student loans as well as other types of debt or to fund upcoming purchases.
                    </p>
                    <p>
                        You can learn more about each of your options from Laurel Road and First Republic respectively.
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="py-2 py-lg-4"></div>
@endsection

@include('member.deal.first-republic-refinance._disclosures')
@include('member.deal.laurel-road-refinance._disclosures')
