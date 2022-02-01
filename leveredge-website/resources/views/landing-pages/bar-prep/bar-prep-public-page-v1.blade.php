@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
    <style>
        @media (min-width: 992px) {
            .negative-padding-on-desktop{
                margin-top: -30px;
            }
        }
    </style>
@endpush

@push('footer-scripts')
    @include('landing-pages.partials._slide-fade-observer')
@endpush

@section('content')
    <div class="container-fluid py-5 bg-light">
        <div class="container narrow px-0 mb-5">
            <div class="col-12 text-center px-lg-5">
                <h1 class="off-black mb-5 px-lg-5">
                    Get a group discount on bar prep and <span class="text-secondary-green">save big</span>
                </h1>
                <p class="font-semibold">
                    Juno uses group buying power to negotiate bar prep discounts—saving members hundreds on advertised prices
                </p>
            </div>
            @php
                $checklist = [
                    'Free for you -
                    <span
                        style="border-bottom:1px dashed #000;"
                        data-toggle="tooltip"
                        title="We charge bar prep companies a fee at the beginning of the process.
                        The only way for them to win our business is for them to offer the lowest prices to our members."
                    >
                        How?
                    </span>',
                    'It takes <1 minute to join',
                    'Already committed?
                    <span
                        style="border-bottom:1px dashed #000;"
                        data-toggle="tooltip"
                        title="You can still join the group if you have already signed up with a bar prep company.">
                    No problem.
                    </span>
                    '
                ];
            @endphp
            <ul class="home-checklist list-unstyled list-inline small text-center mt-5 mt-sm-0">
                @foreach($checklist as $item)
                    @include('landing-pages.partials.home._checklist-item', ['item' => $item])
                @endforeach
            </ul>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 px-lg-5 order-md-2 mb-5">
                    <h5 class="mb-3">
                        <i class="fas fa-users text-secondary-green"></i>
                        {{ $total_applications - $completed_applications }} spots left!
                    </h5>

                    <div class="col-12 rounded-pill mb-3 mb-lg-5 px-0 shadow" style="background:#B3DAD9;">
                        <div
                            class="h-100 rounded-pill bg-secondary-green py-2"
                            style="width:{{ $progress }}%;"
                        ></div>
                    </div>
                    <p class="negative-padding-on-desktop">
                        68,000 people take the bar exam each year. We only need 250.
                    </p>

                    <div class="row mt-4">
                        <div class="col-6">
                            <h5 class="mb-0 font-weight-bold">${{number_format($bar_prep_amount)}}</h5>
                            <p class="mb-3">Costs to be negotiated</p>
                        </div>
                        <div class="col-6">
                            <h5 class="mb-0 font-weight-bold">{{$days_to_go}}</h5>
                            <p class="mb-3">Days to go</p>
                        </div>
                    </div>

                    <a
                        href="{{ \App\QuestionFlow::getInitUrlForFlow(\App\QuestionFlow::BAR_PREP_FLOW_ID) }}"
                        class="btn btn-secondary rounded-pill py-2 px-5 mb-3 font-weight-bold shadow
                        flashing-button"
                    >
                        Join the group
                    </a>

                    <p>
                        <small>
                            <u>All or nothing:</u> We will negotiate a deal if this group reaches 1,000 people
                        </small>
                    </p>
                </div>
                <div class="col-12 col-md-5 mb-5">
                    <img
                        src="{{ asset('/img/landing-page/bar-prep-hero-v1.png') }}"
                        alt="People looking for bar prep discounts"
                        class="img-fluid"
                    >
                </div>
            </div>
        </div>
    </div>

    @include('.landing-pages.bar-prep._tabs')
@endsection
