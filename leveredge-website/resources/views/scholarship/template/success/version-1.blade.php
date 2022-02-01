@extends('template.public')

@php /** @var \App\Scholarship $scholarship **/ @endphp


@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@push('footer-scripts')
    @include('landing-pages.partials._slide-fade-observer')
@endpush

@section('content')
    <div class="container border bg-white p-5 my-5 rounded-lg text-center position-relative">
        <i
            aria-hidden="true"
            class="fas fa-check-circle text-primary mb-4"
            style="font-size:64px;"
        ></i>

        <button
            class="btn btn-sm p-0"
            style="position:absolute;top:0;right:0;font-size:16px;height:30px;width:30px;"
            onClick="this.parentElement.classList.add('d-none')"
        >
            <i
                aria-hidden="true"
                class="fas fa-times text-muted"
            ></i>
        </button>

        {!! $success_message !!}
    </div>

    <div class="container-fluid py-5">
        <div class="container text-center">
            <div class="row justify-content-center">
                <h2 class="text-uppercase">
                    Student Loans, with a Volume Discount
                </h2>
                <div class="col-12 col-lg-10">
                    <h6 class="mb-4 font-semibold">
                        Juno has saved students more than 26 million dollars using collective bargaining.
                    </h6>
                    <p class="mb-5">
                        We allocate a portion of our funding to give back to the community through these monthly scholarships.
                        Join us for free today to help grow our initiative, and save even more on your student loans.
                    </p>
                    <a href="{{ url('loans/undergraduate') }}" class="btn btn-secondary rounded-pill px-5 font-weight-bold">
                        Join us for free
                    </a>
                    <p class="mt-5 mb-4 text-muted">
                        <em>as seen in</em>
                    </p>
                </div>
            </div>

            <div class="row text-center justify-content-start justify-content-md-center">
                <div class="col-auto my-3">
                    <img
                        src="{{ asset('/img/press-logo/wall-street-journal-bg-light-2.png') }}"
                        class="img-fluid"
                    >
                </div>
                <div class="col-auto order-md-4 my-3">
                    <img
                        src="{{ asset('/img/press-logo/above-the-law-horizontal.png') }}"
                        class="img-fluid"
                    >
                </div>
                <div class="col-auto my-3">
                    <img
                        src="{{ asset('/img/press-logo/poets-and-quants-logo-bg-light.png') }}"
                        class="img-fluid"
                    >
                </div>
                <div class="col-auto my-3">
                    <img
                        src="{{ asset('/img/press-logo/boston-globe-logo-light.png') }}"
                        class="img-fluid"
                    >
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid position-relative my-5">
        <div class="container narrow bg-white shadow rounded-lg">
            <div class="row">
                <div class="col-12 p-5">
                    <h5 class="font-weight-bold text-center">FAQs</h5>
                </div>
            </div>

            @foreach($faqs as $faq)
                @include('landing-pages.partials._dropdown', [
                    'trigger' => $faq['question'],
                    'content' => $faq['answer'],
                ])
            @endforeach
        </div>
        <div
            class="col-12 bg-light-green position-absolute"
            style="top:10%;left:0;height:80%;z-index:-1;"
        >

        </div>
    </div>

    <div class="py-5 invisible" aria-hidden="true"></div>

    <div class="container-fluid py-5">
        <div class="container px-0">
            <div class="row">
                <div class="col-12 col-sm-6 bg-primary p-5 text-light">
                    <h2 class="text-white mb-4 mt-5">
                        Created by Harvard Business School students
                    </h2>
                    <p class="mb-5 small">
                        Chris & Nikhil started Juno a few years ago when they got into grad school and realized
                        that they could save money by negotiating their loans.
                    </p>
                </div>
                <div
                    class="col-12 col-sm-6"
                    style="background:url({{ asset('/img/friends-smiling-at-laptop-wide.png') }}) center / cover no-repeat;min-height:200px;"
                ></div>
                <div class="col-12 col-sm-5 bg-light p-5 order-md-2">
                    <h2 class="mb-4 off-black">
                        By students, for students
                    </h2>
                    <p class="mb-3 small">
                        We’re here for you. If you want to chat, contact us:
                    </p>
                    <p class="mb-3 small text-primary">
                        <i class="fas fa-phone mr-2"></i>
                        <a href="tel:617-202-3518" class="text-primary">
                            (617) 209-9651‬
                        </a>
                    </p>
                    <p class="mb-0 small text-primary">
                        <i class="fas fa-envelope mr-2"></i>
                        <a href="mailto:hello@joinjuno.com" class="text-primary">
                            hello@joinjuno.com
                        </a>
                    </p>
                </div>
                <div
                    class="col-12 col-sm-7"
                    style="background:url({{ asset('/img/students-working-at-laptops.png') }}) center / cover no-repeat;min-height:200px;"
                ></div>
            </div>
        </div>
    </div>
{{--    <div class="container-fluid py-5">--}}
{{--        <div class="container my-5">--}}
{{--            <h2 class="text-center mb-5">--}}
{{--                Hear from our members--}}
{{--            </h2>--}}
{{--            <div class="row">--}}
{{--                <div class="col-12 col-sm-4 mb-3">--}}
{{--                    <div class="border p-3 p-lg-5 text-center rounded-lg">--}}
{{--                        <i--}}
{{--                            aria-hidden="true"--}}
{{--                            class="fas fa-quote-right rounded-circle bg-light text-primary mb-3"--}}
{{--                            style="height:60px;width:60px;line-height:60px;font-size:24px;"--}}
{{--                        ></i>--}}
{{--                        <p class="small">--}}
{{--                            <em>--}}
{{--                                "I ended up getting a loan with 5% interest, which to me means about $30,000 savings."--}}
{{--                            </em>--}}
{{--                        </p>--}}
{{--                        <p class="mb-0 small font-weight-bold">--}}
{{--                            Jana, HBS--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-12 col-sm-4 mb-3">--}}
{{--                    <div class="border p-3 p-lg-5 text-center rounded-lg">--}}
{{--                        <i--}}
{{--                            aria-hidden="true"--}}
{{--                            class="fas fa-quote-right rounded-circle bg-light text-primary mb-3"--}}
{{--                            style="height:60px;width:60px;line-height:60px;font-size:24px;"--}}
{{--                        ></i>--}}
{{--                        <p class="small">--}}
{{--                            <em>--}}
{{--                                "I ended up getting a loan with 5% interest, which to me means about $30,000 savings."--}}
{{--                            </em>--}}
{{--                        </p>--}}
{{--                        <p class="mb-0 small font-weight-bold">--}}
{{--                            Jana, HBS--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-12 col-sm-4 mb-3">--}}
{{--                    <div class="border p-3 p-lg-5 text-center rounded-lg">--}}
{{--                        <i--}}
{{--                            aria-hidden="true"--}}
{{--                            class="fas fa-quote-right rounded-circle bg-light text-primary mb-3"--}}
{{--                            style="height:60px;width:60px;line-height:60px;font-size:24px;"--}}
{{--                        ></i>--}}
{{--                        <p class="small">--}}
{{--                            <em>--}}
{{--                                "I ended up getting a loan with 5% interest, which to me means about $30,000 savings."--}}
{{--                            </em>--}}
{{--                        </p>--}}
{{--                        <p class="mb-0 small font-weight-bold">--}}
{{--                            Jana, HBS--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
