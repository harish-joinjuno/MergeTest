<div class="container-fluid py-5">
    <div class="container my-5 px-0 px-sm-3 slide-fade-in">
        <div class="row align-items-stretch">
            <div class="col-12 col-lg-4 p-5 d-flex flex-column justify-content-center bg-secondary-green">
                <h2 class="text-left text-white mb-0">
                    {{ $joinNow ?? 'Join a student loan negotiation group today' }}
                </h2>
            </div>
            <div class="col-12 col-lg-8 d-flex align-items-center px-0 bg-light">
                <div class="row m-0" style="min-width:100%">
                    <div class="col-6 p-5">
                        <div class="square">
                            <img
                                src="{{ asset('/img/students-standing-around-square.png') }}"
                                alt="Students standing around"
                            >
                        </div>
                    </div>
                    <div class="col-6 flex p-5 d-flex flex-column justify-content-center text-center">
                        <p class="mb-0">{{ $userType ?? 'Students' }} signed up so far</p>
                        <h2 class="text-center off-black mb-0">
                            40,000+
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-stretch">
            <div class="col-12 col-lg-4 order-lg-2 p-5 bg-secondary-green d-flex flex-column align-items-center justify-content-center">
                <h4 class="text-center mb-0">
                    <h2 class="text-white mb-0">
                        $250M+ in Loans
                    </h2>
                    <p class="text-white mb-0">secured at the lowest rates</p>
                </h4>
            </div>
            <div class="col-12 col-lg-8 p-0 d-flex flex-column justify-content-center">
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

        <div class="row align-items-stretch">
            <div class="col-12 col-lg-8 bg-secondary-green py-md-5 d-flex flex-column align-items-center justify-content-center">
                <div class="text-center p-5">
                    <h2 class="text-white mb-0">
                        $350M+ in Demand
                    </h2>
                    <p class="mb-0 text-white">secured at the lowest rates</p>
                </div>
            </div>
            <div class="col-12 col-lg-4 p-5 bg-light d-flex flex-column align-items-center justify-content-center">
                <h2 class="text-center off-black">
                    Join now!
                </h2>
                <a href="" class="btn btn-secondary rounded-pill py-3 px-5">
                    Get Started
                </a>
            </div>
        </div>
    </div>
</div>

@include('landing-pages.partials._video-dialog', [
    'youtubeId' => 'Afsb5dD44_c',
])
