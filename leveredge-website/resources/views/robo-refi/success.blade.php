<!DOCTYPE html>
<html lang="en">
@include('robo-refi.head')

<body>

<main id="content" role="main">

    <!-- Hero Section -->
    <div class="gradient-x-overlay-lg-dark-video">
        <!-- Video Background -->
        <div class="js-video-bg d-none d-md-block position-absolute w-100 h-100"
             data-hs-video-bg-options='{
             "type": "you-tube",
             "videoId": "0qisGSwZym4",
             "ratio": 0.75
           }'>
        </div>
        <!-- End Video Background -->

        <div class="position-relative z-index-2">
            <!-- Content -->
            <div class="d-md-flex">
                <div class="container d-md-flex align-items-md-center min-vh-md-100 text-center space-3 space-top-md-4 space-top-lg-3">
                    <div class="w-lg-85 mx-lg-auto">
                        <!-- Info -->
                        <div class="mt-5 mb-7">
                            <h1 class="display-4 text-white mb-3">Thank you!</h1>
                            <p class="lead text-white">We have added your email address to the sign up queue.</p>

{{--                            <h2 class="text-white mt-5">Interested in priority access?</h2>--}}
{{--                            <p class="lead text-white">Get early acccess by referring your friends. The more friends that join, the sooner you'll get access.</p>--}}
{{--                            <p class="lead text-white">Share this unique link:</p>--}}
{{--                            <p class="lead text-white"><a class="text-white" href="{{ $roboRefiUser->referral_link }}">{{ $roboRefiUser->referral_link }}</a></p>--}}
                        </div>
                        <!-- End Info -->
                    </div>
                </div>
            </div>
            <!-- End Content -->

        </div>

        <div class="d-lg-none position-absolute top-0 right-0 bottom-0 left-0 bg-img-hero" style="background-image: url({{ asset("assets/robo-refi/img/1920x1080/img2.jpg") }});"></div>
    </div>
    <!-- End Hero Section -->


    @include('robo-refi.common')

    <!-- JS Global Compulsory -->
    <script src="{{ asset("assets/robo-refi/vendor/jquery/dist/jquery.min.js") }}"></script>
    <script src="{{ asset("assets/robo-refi/vendor/jquery-migrate/dist/jquery-migrate.min.js") }}"></script>
    <script src="{{ asset("assets/robo-refi/vendor/bootstrap/dist/js/bootstrap.bundle.min.js") }}"></script>

    <!-- JS Implementing Plugins  -->
    <script src="{{ asset("assets/robo-refi/vendor/typed.js/lib/typed.min.js") }}"></script>
    <script src="{{ asset("assets/robo-refi/aos/aos.js") }}"></script>



    <!-- JS Front -->
    <script src="{{ asset("assets/robo-refi/js/theme.min.js") }}"></script>

    <!-- JS Plugins Init -->
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF TEXT ANIMATION (TYPING)
            // =======================================================
            var typed = $.HSCore.components.HSTyped.init(".js-text-animation");

            // INITIALIZATION OF AOS
            // =======================================================
            AOS.init({
                duration: 650,
                once: true
            });
        });
    </script>
</main>
</body>
</html>

