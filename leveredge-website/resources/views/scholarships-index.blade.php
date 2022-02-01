@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@section('content')
    <div class="container py-5 my-5">
        <h1 class="text-center mb-5">What are you looking for?</h1>
        <div class="row justify-content-center">
            <div class="col-12 col-md-3">
                <div class="card p-3 text-center">
                    <img
                        src="{{ ('/img/grad-scholarships.png') }}"
                        alt="General Scholarships"
                        class="mb-3 mx-auto"
                        style="max-width:150px;"
                    >
                    <h6 style="min-height:6em">
                        MBA Scholarships
                    </h6>

                    <a
                        aria-label="Browse MBA Scholarships"
                        href="{{ url('/search-mba-scholarships') }}"
                        class="btn btn-primary text-white px-0"
                    >
                        Select
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card p-3 text-center">
                    <img
                        src="{{ ('/img/law-scholarships.png') }}"
                        alt="General Scholarships"
                        class="mb-3 mx-auto"
                        style="max-width:150px;"
                    >
                    <h6 style="min-height:6em">
                        Law Scholarships
                    </h6>

                    <a
                        aria-label="Browse Law Scholarships"
                        href="{{ url('/search-law-scholarships') }}"
                        class="btn btn-primary text-white px-0"
                    >
                        Select
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card p-3 text-center">
                    <img
                        src="{{ ('/img/general-scholarships.png') }}"
                        alt="General Scholarships"
                        class="mb-3 mx-auto"
                        style="max-width:150px;"
                    >
                    <h6 style="min-height:6em">
                        General Scholarships
                    </h6>

                    <a
                        aria-label="Browse General Scholarships"
                        href="{{ url('/general-scholarships') }}"
                        class="btn btn-primary text-white px-0"
                    >
                        Select
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
