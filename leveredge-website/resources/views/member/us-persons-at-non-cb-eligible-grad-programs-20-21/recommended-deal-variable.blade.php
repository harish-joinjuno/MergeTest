@extends('member.us-persons-at-cb-eligible-programs-20-21.recommended-deal-base')

@push('below-nav')
    @include('common._banner_graduate_student_loan_calculator')
@endpush

@section('deal-content')

    <div class="container py-0 my-0">
        <div class="row">
            <div class="col-12">
                <p class="text-center">
                    <a href="{{ url('/how-we-make-money') }}">Advertising Disclosure</a>
                </p>
            </div>
        </div>
    </div>

    @include('member.us-persons-at-cb-eligible-programs-20-21.recommended-deal-partials.fixed-or-variable-toggle',['selected' => 'variable'])

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <h1 class="text-center off-black mb-3">Negotiated just for you</h1>
            </div>
        </div>
    </div>

    <div class="jumbotron bg-white pb-5 pt-0 my-0">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-lg-9">
                    <div class="title text-center">
                        <h4 class="text-center fw-600">Variable Rate Option</h4>
                    </div>
                    <p class="text-center">
                        We expect you'll find great variable rates from one of Credible's partner lenders.
                        While these rates are not exclusive to Juno Members, <strong>you'll receive a cash reward from Juno</strong> when you click below, prequalify for rates with Credible and close a loan with one of Credible's partner lenders, that you wouldn't receive otherwise.
                    </p>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-12 col-md-6 px-0 px-lg-3">
                    @include('member.us-persons-at-cb-eligible-programs-20-21._credible_card')
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
                <div class="title text-center">
                    <h4 class="text-center fw-600">Fixed Rate Option</h4>
                </div>
                <p class="text-center">Earnest Private Student Loans offers the lowest fixed rates we expect you will
                    receive. Negotiated rates are <strong>at least 0.8% lower</strong> than you would find directly on Earnest (for
                    Graduate no-cosigner loans with deferred payments and fixed rates) and <strong>up to 4.00% lower</strong>.</p>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-6">
                @include('member.us-persons-at-cb-eligible-programs-20-21._earnest_card')
            </div>
        </div>
    </div>

<div class="py-2 py-lg-4"></div>

<div class="jumbotron bg-translucent-green mb-0">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4">
                <p class="fw-600">Common Question:</p>
                <h2 class="off-black">How does shopping around impact me?</h2>
                <div class="row mt-4 mb-4 mb-lg-0">
                    <div class="col-10">
                        <img src="{{ asset('img/plane-fall-2020.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <p>
                    Credible utilizes a soft credit check in order to show you prequalified rates, while Earnest
                    requires a hard credit check. A soft credit check will not show up on your credit report when
                    a creditor pulls your report.
                </p>
                <p>
                    However, <a target="_blank" href="{{ url('https://www.experian.com/blogs/ask-experian/credit-education/report-basics/hard-vs-soft-inquiries-on-your-credit-report/') }}">according to this article from Experian</a>, rate shopping is common and multiple inquiries
                    for one kind of credit product, such as a student loan,  in a short period counts as a single inquiry
                    which will have a relatively small impact on your credit score.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
