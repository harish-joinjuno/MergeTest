@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@section('content')
    <div class="container-fluid py-5">
        <div class="container px-0 my-5">
            <div class="col-12 text-center px-0">
                <h1 class="off-black mb-5">
                    Accessibility statement
                </h1>
                <p class="font-semibold">
                    Last Updated: August 2020
                </p>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 bg-light">
        <div class="container ultra-narrow px-0 my-5">
            <div class="col-12 text-center px-0">
                <h4 class="off-black underlined my-5">
                    General statement
                </h4>
                <p class="font-semibold">
                    At Juno we keep a constant eye on contrast, button size, cohesiveness, coherency, and we
                    truly feel that our services should strive to meet the needs of not just our able members, but
                    all people, including those with accessibility impairments. Something we’re trying to push for
                    with our products is the idea that everyone can have access to an affordable education. Right
                    now we’re in the middle of getting a good baseline for our web experience. We are taking measures
                    to ensure that all of the pages on our website meet Web Content Accessibility Guidelines, at the
                    AA level.
                </p>
                <h4 class="off-black underlined pt-5 my-5">
                    Site disclaimer
                </h4>
                <p class="font-semibold">
                    Despite our efforts to make all pages and content on joinjuno.com accessible for everyone, know
                    that this is a work in progress. If there is anything on our site that is not fully accessible,
                    this may be a result of joinjuno.com not having found or identified the most appropriate
                    solution from either a technological or implementation perspective. When this occurs, please
                    note that we’re working diligently to fulfill any and all inaccessibility concerns.
                </p>
                <h4 class="off-black underlined pt-5 my-5">
                    Can we help?
                </h4>
                <p class="font-semibold">
                    If you’re experiencing any difficulties with joinjuno.com know that we’re very happy to assist
                    you in accessing our site and our products. Feel free to send us a message at Support@joinjuno.com
                    and we’ll set up a zoom call together.
                </p>
                <h4 class="off-black underlined pt-5 my-5">
                    Reporting a concern
                </h4>
                <p class="font-semibold">
                    On the same note, if you’d like to call out a site experience that could be more accessible
                    feel free to send a message to
                    <a href="mailto:support@joinjuno.com"
                       target="_blank"
                       rel="noreferrer noopener">
                        support@joinjuno.com.
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
