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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyAndShareButton = document.getElementById('copyAndShare');
            const copyAndShareInput = document.getElementById('copyAndShareInput');
            const oldTitle = copyAndShareButton.title;

            copyAndShareButton.addEventListener('click', function() {
                copyAndShareInput.select();
                document.execCommand('copy');
                $(copyAndShareButton)
                    .attr('data-original-title', 'Copied to Clipboard!')
                    .tooltip('show');

                setTimeout(function() {
                    copyAndShareInput.blur();
                    $(copyAndShareButton)
                        .attr('data-original-title', oldTitle)
                        .tooltip('show');
                }, 2500);
            });
        });
    </script>
@endpush

@section('content')
    <div class="container-fluid py-5 bg-light">
        <div class="container px-0 mb-5">
            <div class="col-12 text-center px-lg-5">
                <h1 class="off-black mb-2">
                    We need your help to grow the bar prep group
                </h1>
                <h5 class="font-semibold mt-3">
                    The more people who join, the more negotiating power we all have.
                </h5>
            </div>
        </div>


        @php
            $difference = 1000 - ($completed_applications ?? 0);
            $facebookShareMessage = "Hey everyone, I wanted to share an opportunity to save us all some money on your bar exam prep course for free: an organization called Juno will go negotiate with bar prep companies to get an exclusive deal for everyone in the group. It's no commitment, no obligation, they've done this with student loans and are now doing it for bar prep. The more people we have in the group the better the deal will be. Join me and sign up today.";
            $twitterShareMessage = "If anyone is looking to get a great discount on your bar exam prep course, join the Juno group for free so they can negotiate a deal on everyone's behalf.";
        @endphp


        <div class="container">
            <div class="row h-100 justify-content-center">
                <div class="col-12 col-md-7 px-lg-5 order-md-2 mb-5 my-md-auto">
                    <h5 class="mb-3 text-center text-md-left">
                        You have {{ $days_to_go }} days to get your friends in on this.
                    </h5>

                    <div class="col-12 col-md-10 rounded-pill mb-3 mb-lg-5 px-0 shadow" style="background:#B3DAD9;">
                        <div
                            class="h-100 rounded-pill bg-secondary-green py-2"
                            style="width:{{ $progress }}%;"
                        ></div>
                    </div>
                    <p class="negative-padding-on-desktop mb-2">
                        {{ $total_applications - $completed_applications }} spots left!
                    </p>
                    <p>
                        68,000 people take the bar exam each year. We only need 250.
                    </p>
                </div>
                <div class="col-12 col-md-4 mb-5 my-md-auto">
                    <div
                        class="bg-secondary px-3 px-lg-4 py-4 shadow">
                        <h6 class="font-weight-bold mb-3">
                            Thank you, {{optional(user())->first_name}} {{optional(user())->last_name}}
                        </h6>
                        <p class="mb-n2">Nikhil & Chris</p>
                        <p class="mb-0"><small>Founders, Juno</small></p>
                        <svg
                            width="50"
                            height="50"
                            viewBox="0 0 59 59"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="position-absolute"
                            style="top:-20px;left:-20px;"
                        >
                            <path
                                d="M18.8832 27.1934C17.4301 26.7751 15.9769 26.5628 14.5634 26.5628C12.3806 26.5628
                                10.5592 27.0616 9.14692 27.6725C10.5085 22.6879 13.7793 14.0872 20.2949 13.1187C20.8983
                                13.0289 21.3928 12.5926 21.5574 12.0053L22.9814 6.91181C23.1015 6.48106 23.0303 6.01999
                                22.7846 5.64618C22.5389 5.27237 22.1441 5.02295 21.7016 4.9623C21.2207 4.8967 20.7306
                                4.86328 20.2447 4.86328C12.4239 4.86328 4.67858 13.0264 1.41026 24.7148C-0.508277
                                31.5721 -1.07084 41.8815 3.65495 48.3706C6.29944 52.0016 10.1576 53.9406 15.1222
                                54.1343C15.1427 54.1349 15.1625 54.1356 15.1829 54.1356C21.3086 54.1356 26.7405 50.0101
                                28.393 44.104C29.3801 40.5732 28.9339 36.8704 27.1354 33.6751C25.3561 30.5156 22.4257
                                28.2128 18.8832 27.1934Z"
                                fill="#278D87"
                            />
                            <path
                                d="M57.2286 33.6757C55.4493 30.5156 52.5189 28.2128 48.9764 27.1934C47.5232 26.7751
                                46.0701 26.5628 44.6572 26.5628C42.4744 26.5628 40.6524 27.0616 39.2401 27.6725C40.6017
                                22.6879 43.8725 14.0872 50.3887 13.1187C50.9921 13.0289 51.486 12.5926 51.6512
                                12.0053L53.0752 6.91181C53.1953 6.48106 53.1241 6.01999 52.8784 5.64618C52.6334
                                5.27237 52.2385 5.02295 51.7954 4.9623C51.3151 4.8967 50.825 4.86328 50.3385
                                4.86328C42.5177 4.86328 34.7724 13.0264 31.5035 24.7148C29.5855 31.5721 29.023
                                41.8815 33.7494 48.3718C36.3933 52.0023 40.252 53.9419 45.216 54.1349C45.2365
                                54.1356 45.2563 54.1362 45.2773 54.1362C51.4024 54.1362 56.835 50.0107 58.4874
                                44.1046C59.4733 40.5738 59.0264 36.8704 57.2286 33.6757Z"
                                fill="#278D87"
                            />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3 mt-md-5">
                <div class="col-6 col-lg-3 mb-3">
                    <a
                        href="https://www.facebook.com/dialog/share?app_id=2142075722511834&display=popup&href={{ url('/loans/auto-refinance?grow=' . user()->referral_code ) }}&quote={{ $facebookShareMessage }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        id="facebookButton"
                        class="btn btn-sm btn-block text-white px-0 py-2"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Share on Facebook"
                        style="background-color:#445691;"
                    >
                        <i class="fab fa-facebook mr-1"></i>
                        Facebook
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <a
                        href="https://twitter.com/intent/tweet?text={{ $twitterShareMessage }}&url={{ url('/test-prep/bar-prep?grow=' . user()->referral_code ) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn-sm btn-block text-white px-0  py-2"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Share on Twitter"
                        style="background-color:#64A6E4;"
                    >
                        <i class="fab fa-twitter mr-1"></i>
                        Twitter
                    </a>
                </div>
                {{--                                <div class="col-6 mb-3">--}}
                {{--                                    <a--}}
                {{--                                        href="https://www.facebook.com/dialog/send?app_id=2142075722511834&link={{ url('/loans/auto-refinance?grow=' . user()->referral_code ) }}"--}}
                {{--                                        target="_blank"--}}
                {{--                                        rel="noopener noreferrer"--}}
                {{--                                        id="messengerButton"--}}
                {{--                                        class="btn btn-sm btn-block text-white px-0"--}}
                {{--                                        data-toggle="tooltip"--}}
                {{--                                        data-placement="top"--}}
                {{--                                        title="Share on Messenger"--}}
                {{--                                        style="background-color:#01A6FF;"--}}
                {{--                                    >--}}
                {{--                                        <i class="fab fa-facebook-messenger mr-1"></i>--}}
                {{--                                        Messenger--}}
                {{--                                    </a>--}}
                {{--                                </div>--}}
                <div class="col-6 col-lg-3 mb-3">
                    <button
                        id="copyAndShare"
                        class="btn btn-sm btn-block text-white px-0 py-2"
                        style="background-color:#3F3356;"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Copy the URL"
                    >
                        <i class="fas fa-copy mr-1"></i>
                        Copy &amp; Share
                    </button>

                    <input
                        aria-hidden="true"
                        class="form-control"
                        id="copyAndShareInput"
                        type="text"
                        value="{{ url('/test-prep/bar-prep?grow=' . user()->referral_code ) }}"
                        style="position:absolute;top:-9999%;left:-9999%;"
                        readonly
                    >
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <h5 class="text-center" style="font-weight: 400">
                        <u>All or nothing:</u> We will negotiate a deal if this group reaches 1,000 people
                    </h5>
                </div>
            </div>

        </div>
    </div>

    @include('.landing-pages.bar-prep._tabs')


@endsection
