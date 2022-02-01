@extends('template.public')

@php /** @var \App\Scholarship $scholarship **/ @endphp

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
    <style>
        .img-backdrop {
            position:relative;
            box-shadow:100px 50px 0 #ECF3F3;
        }
        .banner-tag {
            position:absolute;
            top:0;
            right:15px;
            height:24px;
            width:24px;
            font-size:12px;
            font-weight:600;
            line-height:24px;
        }
        .banner-tag:after {
            top: 100%;
            left: 50%;
            border: solid transparent;
            content: "";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-color: rgba(255, 255, 255, 0);
            border-top-color: #2F706B;
            border-width: 12px;
            margin-left: -12px;
        }
    </style>
@endpush

@include('landing-pages.partials._select-2-injection')

@section('content')

    <div class="py-3"></div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 mb-5">
                <div class="row justify-content-center mb-3">
                    <div class="col-12 col-lg-8">
                        <h6 class="text-center my-5">
                            {!! $form_heading !!}
                        </h6>
                    </div>
                </div>

                <form method="post" action="{{ url('/scholarship/' . $scholarship->slug) }}">
                    @csrf
                    <div class="row">
                        @foreach($scholarship->scholarshipQuestions as $scholarshipQuestion)
                            @php /** @var \App\ScholarshipQuestion $scholarshipQuestion **/ @endphp
                            @include('scholarship.question.' . $scholarshipQuestion->type)
                        @endforeach
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-8 col-md-6 text-center">
                            <button
                                type="submit"
                                class="btn btn-primary rounded-pill btn-block px-5 py-2 my-3"
                            >
                                {{ __('Let\'s go!') }}
                            </button>
                        </div>
                        <div class="col-12 text-center">
                            <p class="small">
                                We don't sell your information to anyone. Scroll down to learn more.
                            </p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 col-sm-8 offset-sm-1 col-lg-4 mb-5 pl-4 position-relative">
                <img
                    src="{{ asset('/img/friends-smiling-at-laptop.png') }}"
                    alt="Friends Smiling at Laptop"
                    class="img-fluid img-backdrop rounded-lg"
                >
                <div
                    class="bg-secondary px-3 px-lg-4 py-4 position-absolute shadow rounded"
                    style="top:-1px;left:-1px;max-width:80%;"
                >
                    <div class="small mb-0" style="font-weight: 500;">
                        {!! $voice ?? '' !!}
                    </div>
                </div>

                @if(!empty($description))
                    <div class="row mt-5">
                        <div class="col-12 px-0">
                            <div class="bg-primary p-3">
                                <p class="text-white small mb-0">
                                    {!! $description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light-green">
        <div class="container" style="height:0;">
            <div class="row  text-center text-sm-right" style="transform:translateY(-50%)">
                <div class="col">
                    <img
                        src="{{ asset('/img/students-looking-upwards.png') }}"
                        alt="Flavor Image"
                        aria-hidden="true"
                        style="max-width:150px;"
                    >
                </div>
            </div>
        </div>

        <div class="container narrow text-center py-5 my-5">
            <h2>
                {!! $cta_heading !!}
            </h2>
            <h6 class="font-weight-bold mb-2">
                {!! $cta_sub_heading !!}
            </h6>
            <p>
                {!! $cta_body !!}
            </p>
            <h6 class="font-weight-bold my-5">
                {!! $cta_pre_button_text !!}
            </h6>
            <a href="{{ url('/') }}" class="btn btn-primary py-2 px-5 rounded-pill">
                {!! $cta_button_text !!}
            </a>
        </div>

        <div class="container" style="height:0;">
            <div class="row text-center text-sm-left" style="transform:translateY(-50%)">
                <div class="col">
                    <img
                        src="{{ asset('/img/better-loans.png') }}"
                        alt="Flavor Image"
                        aria-hidden="true"
                        style="max-width:150px;"
                    >
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container narrow mt-5">
            <div class="row justify-content-center">
                @foreach($scholarship->scholarshipWinners as $winner)
                    <div class="col-6 col-lg-4 mb-5 text-center">
                        <div
                            class="col mx-auto mb-2"
                            style="width:175px;"
                        >
                            <div
                                class="square rounded"
                                style="background:url({{ $winner->photo }}) center / cover no-repeat;"
                            >
                                <span class="banner-tag bg-primary text-white text-center shadow">
                                    1
                                </span>
                            </div>
                        </div>
                        <p class="font-weight-bold">
                            {{ $winner->title }}
                        </p>
                        <p class="mb-0 small">
                            {{ $winner->name }}, {{ $winner->university }}
                        </p>
                        <p class="small">
                            {{ $winner->year }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="py-3"></div>
@endsection
