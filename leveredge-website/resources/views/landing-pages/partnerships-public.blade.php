@extends('landing-pages.landing-page-layout', [
    'pageHeading' => 'Partner with Juno & help your members tackle their student loan debt',
    'headingFlavorText' => 'We offer exclusive rate discounts, scholarships, financial literacy, and much more!',
    'hideForm' => true,
    'headingBackgroundImage' => '/assets/images/pink-balloon.png',
    'hideBottom' => true,
])

@push('header-scripts')
    <style>
        .bg-dark-green {
            background:#B3DAD9;
        }
    </style>
@endpush

@section('customCTA')
    <a
        href="https://calendly.com/leveredge-partnerships/intro-to-leveredge"
        class="btn btn-lg bg-secondary rates-button px-5 mt-3 font-weight-bold"
    >
        Schedule a call
    </a>
@endsection

@section('page-body')
    <div class="container-fluid bg-light-green py-5">
        <div class="container my-5 px-0">
            <h4 class="underlined text-center mb-5">What is Juno?</h4>

            <div class="row align-items-stretch bg-dark-green">
                <div class="col-12 col-lg-4 p-5 bg-white d-flex flex-column justify-content-center">
                    <h4 class="text-left mb-0">
                        We are on a mission to increase access to and reduce the financial burden of higher education.
                    </h4>
                </div>
                <div class="col-12 col-lg-8 bg-dark-green d-flex align-items-center px-0">
                    <div class="row m-0" style="min-width:100%">
                        <div class="col-6 p-5">
                            <div class="square">
                                <img
                                    src="{{ asset('/img/students-standing-around-square.png') }}"
                                    alt="Students standing around"
                                >
                            </div>
                        </div>
                        <div class="col-6 flex p-5 d-flex flex-column justify-content-center">
                            <h2 class="text-center off-black mb-0">
                                40,000+
                                <br />
                                Members
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-stretch bg-dark-green">
                <div class="col-12 col-lg-4 order-lg-2 p-5 bg-white d-flex flex-column align-items-center justify-content-center">
                    <h4 class="text-left mb-0">
                        We do this by getting students lower rates on loans than they could ever get on their own through group buying.
                    </h4>
                </div>
                <div class="col-12 col-lg-8 bg-dark-green p-0 d-flex flex-column justify-content-center">
                    <div
                        class="img-box video-box"
                        style="background:url({{ asset('/img/testimonial-thumbnail.png') }}) no-repeat center/cover;"
                        role="button"
                        tabindex="0"
                        data-toggle="modal"
                        data-target="#videoModal"
                    >
                        <div class="absolute-center p-5 bg-black text-center">
                            <span
                                class="d-inline-block play-button rounded-circle cursor-pointer"
                            >
                                <svg
                                    aria-hidden="true"
                                    focusable="false"
                                    role="img"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0
                                        37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"
                                    ></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-stretch bg-dark-green">
                <div class="col-12 col-lg-4 order-lg-2 p-5 bg-dark-green d-flex flex-column align-items-center justify-content-center">
                    <h2 class="text-center off-black">
                        100+ million in savings
                    </h2>
                    <h6 class="text-center">
                        Between initial loan rate reductions and member rewards
                    </h6>
                </div>
                <div class="col-12 col-lg-8 bg-light py-md-5 d-flex flex-column align-items-center justify-content-center">
                    <div class="p-5">
                        <h2 class="text-center off-black mb-5">
                            And we need your help to reach more people.
                        </h2>
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-3">
                                <a
                                    href="mailto:partnerships@joinjuno.com"
                                    class="btn btn-block bg-white border-secondary rounded-pill font-weight-bold"
                                >
                                    Email us
                                </a>
                            </div>
                            <div class="col-12 col-sm-6">
                                <a
                                    href="https://calendly.com/leveredge-partnerships/intro-to-leveredge"
                                    class="btn btn-block bg-secondary rounded-pill font-weight-bold"
                                >
                                    Schedule a call
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('landing-pages.partials._video-dialog', [
        'youtubeId' => 'Afsb5dD44_c',
    ])

    <div class="container-fluid bg-light py-5">
        <div class="container my-5 px-0">
            <h4 class="text-center underlined mb-5">
                Services we'd love to partner on
            </h4>
            <div class="row align-items-stretch py-5">
                <div class="col-12 col-md-6 d-flex flex-column mb-4">
                    <div class="shadow-sm p-3 bg-white rounded d-flex flex-column">
                        <h5 class="font-weight-bold off-black">Undergraduate loans</h5>
                        <p style="min-height:5em;">
                            For undergrads who’ve hit the caps on Federally Held Student Loans. Our deal takes off 1% on
                            interest (ex. 5% ->4%) & has no origination fee.
                        </p>
                        <a
                            href="https://calendly.com/leveredge-partnerships/intro-to-leveredge"
                            class="text-primary"
                            style="font-weight:600;"
                        >
                            <u>Connect on Undergrad loans</u>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex flex-column mb-4">
                    <div class="shadow-sm p-3 bg-white rounded d-flex flex-column">
                        <h5 class="font-weight-bold off-black">Graduate loans</h5>
                        <p style="min-height:5em;">
                            A good alternative to Federal Loans for people with good credit or a co-signer.
                            All graduate deals feature cashback rewards.
                        </p>
                        <a
                            href="https://calendly.com/leveredge-partnerships/intro-to-leveredge"
                            class="text-primary"
                            style="font-weight:600;"
                        >
                            <u>Connect on Graduate loans</u>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex flex-column mb-4">
                    <div class="shadow-sm p-3 bg-white rounded d-flex flex-column">
                        <h5 class="font-weight-bold off-black">Refinance loans</h5>
                        <p style="min-height:5em;">
                            Lower your existing student loans by converting them into a new loan with a better interest rate. Best for people with a steady income. Depending on borrower location & occupation,
                            we’ll recommend the best option. Most deals feature cashback or a rate reduction.
                        </p>
                        <a
                            href="https://calendly.com/leveredge-partnerships/intro-to-leveredge"
                            class="text-primary"
                            style="font-weight:600;"
                        >
                            <u>Connect on Refinance loans</u>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4 text-center">
                    <img class="img-fluid" src="{{ asset('/img/students-running.png') }}" alt="Students running">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container my-5">
            <h4 class="text-center underlined mb-5">
                Some of the many benefits
            </h4>
        </div>
    </div>

    @include('landing-pages.partials._static-image-text', [
        'image' => asset('/img/summer-season-with-check.png'),
        'heading' => 'Refinancing that gives you back a little extra',
        'description' => 'You’ll receive up to $1,000 total (from both us and our lenders) for refinancing through us.',
        'alignRight' => true,
    ])

    @include('landing-pages.partials._static-image-text', [
        'image' => asset('/img/textbooks.png'),
        'heading' => 'Resources to get the full picture',
        'description' => 'Help your members gain control over their finances with our financial literacy tools and training programs.',
        'alignRight' => false,
        'bgLight' => true,
    ])

    @include('landing-pages.partials._static-image-text', [
        'image' => asset('/img/selfless.png'),
        'heading' => 'We’re here for you every step of the way',
        'description' => 'We’ll give you 1-on-1 phone support to help your community tackle their student debt.',
        'alignRight' => true,
    ])

    <div class="container-fluid py-5 bg-light">
        <div class="container narrow my-5 text-center">
            <h1 class="off-black mb-2">Interested in partnering with us?</h1>
            <img class="img-fluid" src="{{ asset('/img/welcome-hero.png') }}" alt="">
            <p class="mb-5">
                Our Partnerships Team would love to speak with you.
                <br>
                Drop them a line at <a href="mailto:partnerships@joinjuno.com">partnerships@joinjuno.com</a>
                or use the button below to schedule a call.
            </p>
            <a
                href="https://calendly.com/leveredge-partnerships/intro-to-leveredge"
                class="btn btn-lg rounded-pill bg-secondary rates-button font-weight-bold px-5"
            >
                Schedule a call
            </a>
        </div>
    </div>
@endsection
