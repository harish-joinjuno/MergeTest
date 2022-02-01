@extends('template.public')

@push('header-scripts')
    <style>
        h1{
            font-size: 32px;
        }
    </style>
@endpush

@section('content')
    <div class="py-3 py-lg-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="off-black">
                    The next page suggests you will receive $500 from Earnest.
                    Unfortunately, residents of Michigan, Massachusetts and Kentucky are not eligible for the $500 bonus from Earnest.
                </h1>

                <h1 class="off-black mt-5">
                    This doesn't impact your eligibility for Juno Rewards.
                </h1>

                <a href="{{ $url }}" class="btn btn-lg btn-primary mt-4">Continue to Earnest</a>
            </div>
        </div>
    </div>
    <div class="py-5"></div>
@endsection
