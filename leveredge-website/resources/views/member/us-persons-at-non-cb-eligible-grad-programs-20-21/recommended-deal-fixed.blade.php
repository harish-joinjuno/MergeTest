@extends('member.us-persons-at-cb-eligible-programs-20-21.recommended-deal-base')

@push('below-nav')
    @include('common._banner_graduate_student_loan_calculator')
@endpush

@section('deal-content')

@include('member.us-persons-at-cb-eligible-programs-20-21.recommended-deal-partials.fixed-or-variable-toggle',['selected' => 'fixed'])
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
                    <h4 class="text-center fw-600">Fixed Rate Option</h4>
                </div>
                <p class="text-center">Earnest Private Student Loans offers the lowest fixed rates we expect you will
                    receive. Negotiated rates are <strong>at least 0.8% lower</strong> than you would find directly at Earnest (for
                    Graduate no-cosigner loans with deferred payments and fixed rates) and <strong>up to 4.00% lower</strong>.</p>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-6 px-0 px-lg-3">
                @include('member.us-persons-at-cb-eligible-programs-20-21._earnest_card')
            </div>
        </div>
    </div>
</div>

<div class="py-2 py-lg-4"></div>
@endsection
