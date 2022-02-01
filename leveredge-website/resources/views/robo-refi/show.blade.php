<!DOCTYPE html>
<html lang="en">
@include('robo-refi.head')

<body>

<main id="content" role="main">


    <!-- Hero Section -->
    <div class="overflow-hidden">
        <div class="container space-top-2 space-top-md-2 space-bottom-3">
            <div class="row justify-content-lg-between align-items-md-center">
                <div class="col-md-6 col-lg-5 mb-7 mb-md-0">
                    <div class="mb-5">
{{--                        <span class="d-block small font-weight-bold text-cap mb-2">Who we are?</span>--}}
                        <h1 class="display-4 mb-3">
                            What if your<br>
                            <span class="text-primary text-highlight-warning">
                                <span class="js-text-animation"
                                      data-hs-typed-options='{
                                        "strings": ["student loan", "car loan", "mortgage"],
                                        "typeSpeed": 90,
                                        "loop": true,
                                        "backSpeed": 30,
                                        "backDelay": 2500
                                      }'></span></span>
                            <br>payment could only go down?
                        </h1>
                        <p class="lead">Introducing automatic refinancing. The first robo advisor for debt.
                    </div>
                    <!-- Form -->
                    <form class="js-validate mb-7" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col-sm col-md-6 col-lg mb-2">
                                <div class="js-form-message">
                                    <label class="sr-only" for="signupSrEmail">Your email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" id="signupSrEmail" placeholder="Your email" aria-label="Your email" required
                                               data-msg="Please enter a valid email address." autofocus>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-auto">
                                <button type="submit" class="btn btn-primary btn-block">Join the Waitlist</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>

                <div class="col-md-6 text-center">
                    <div class="position-relative">
                        <img class="img-fluid rounded-lg" src="{{ asset("assets/robo-refi/img/378x378/image_1.png") }}" alt="Image Description">
                    </div>
                </div>
            </div>
        </div>
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



{{--<section>--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 text-center">--}}
{{--                <h1 class="hero-title">--}}
{{--                    What if your student loan payment could only go down?--}}
{{--                </h1>--}}
{{--                <p>--}}
{{--                    We continually check to determine if you can save money by refinancing your student, auto, personal, or home loan.--}}
{{--                    Once we've found an opportunity, you can use it, or just ask us to take care of it seamlessly.--}}
{{--                    No more leaving cash on the table.--}}
{{--                </p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}


{{--<h1>Robo Refi</h1>--}}


{{--<form method="post">--}}
{{--    @csrf--}}
{{--    <label>Email</label>--}}
{{--    <input name="email" type="email" value="">--}}
{{--    <input type="submit" value="Join Wait list" />--}}
{{--    @error('email')--}}
{{--    {{ $message }}--}}
{{--    @enderror--}}
{{--</form>--}}

{{--<section>--}}
{{--    <h2>How It Works</h2>--}}
{{--    <h3>--}}
{{--        During on-boarding, you'll help us understand your preferences and goals as well as your credit history.--}}
{{--        Then, we'll get to work.--}}
{{--        Our software will determine if you are likely to find an opportunity to refinance your loans.--}}
{{--        Using a combination of our predictive algorithms and actual quotes based on soft credit checks, we'll determine if you'll be able to refinance your loans to get closer to your goals.--}}
{{--        If you've pre-approved us, awesome, we'll go ahead and refinance your loans for you.--}}
{{--        If not, we'll send you an email with a summary of our recommendations.--}}
{{--    </h3>--}}
{{--</section>--}}

{{--<section>--}}
{{--    <h2>How do we make money?</h2>--}}
{{--    <h3>--}}
{{--        We only get paid if we find you an opportunity you take advantage of.--}}
{{--    </h3>--}}
{{--</section>--}}

{{--<section>--}}
{{--    <h2>Peace of Mind</h2>--}}
{{--    <h3>Secure Data</h3>--}}
{{--    <p>--}}
{{--        We keep your data safe with 256 bit encryption. We’ll never sell or rent your data to a third party.--}}
{{--        We only use your data to help you save money on your loans. Read our <a href="{{ url('/privacy') }}">plain english privacy policy here</a>.--}}
{{--    </p>--}}

{{--    <h3>Fiduciary Responsibility</h3>--}}
{{--    <p>--}}
{{--        We take on a Fiduciary Responsibility. This means that we are legally required to put your interests ahead--}}
{{--        of our own. It’s illegal for us not to.--}}
{{--    </p>--}}
{{--</section>--}}

{{--<section>--}}
{{--    <h2>FAQs</h2>--}}
{{--    <h3>How will Juno be able to refinance my loans on my behalf?</h3>--}}
{{--    <p>--}}
{{--        During on-boarding, we ask you to sign a Limited Power of Attorney. This allows us to act on your behalf,--}}
{{--        in your best interest as we interact with lenders/banks etc.--}}
{{--    </p>--}}

{{--    <h3>How do you know what is in my best interest?</h3>--}}
{{--    <p>--}}
{{--        During on-boarding, we ask you several questions that ensure we know your preferences. This ensures we are--}}
{{--        acting in your best interest. You can update your preferences at any time. Further, if we are ever in doubt,--}}
{{--        if a refinance offer is in your best interest or not, we will ask you.--}}
{{--    </p>--}}
{{--</section>--}}
