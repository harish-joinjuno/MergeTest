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
    <div class="py-5 py-lg-3"></div>

    @include('member._without_job_and_federal_info')

    <div class="py-5 py-lg-3"></div>

    @yield('deal-content')
    @include('common.faqs')
    @include('common.got-questions')

@endsection

@push('custom-disclaimers')
    <p class="text-footer-disclaimer">
        Juno receives a fee when you take a loan from any of our partner lenders or a lender on a partner's marketplace.
    </p>
@endpush
