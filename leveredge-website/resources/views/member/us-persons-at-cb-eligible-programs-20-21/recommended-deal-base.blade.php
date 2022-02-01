@extends('template.public')

@push('header-scripts')
    <style>
        .variable-or-fixed-row a{
            color: #222222;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('mix/css/pages/recommended-deals.css') }}">
@endpush

@push('footer-scripts')
    <script src="{{ asset('/vendor/voila/campaign.js') }}"></script>
@endpush

@section('content')
    <div class="py-5"></div>

    @yield('deal-content')


    @include('common.resources')
    <div class="py-5"></div>
    @include('common.faqs')
    @include('common.got-questions')

@endsection

@push('custom-disclaimers')
    <p class="text-footer-disclaimer">
        Juno receives a fee when you take a Earnest Private Student Loan. Juno receives a fee when you take a loan from any of our partner lenders or a lender on a partner marketplace.
    </p>
@endpush
