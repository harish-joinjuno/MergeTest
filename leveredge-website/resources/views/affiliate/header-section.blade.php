<div class="jumbotron mt-0 mb-0 pt-0 pb-0 flanked-images bg-white">
    <div class="container pb-5 pt-5">

        <div class="row">
            <div class="col-12 col-lg-6 d-flex justify-content-center flex-column">
                <h5 class="text-uppercase d-none d-md-block">Don't Leave Your Friends Behind</h5>
                <h1 class="mt-3 brand-color text-uppercase text-center text-md-left" style="font-size: 34px; letter-spacing: 1.5px;">
                    <strong>
                        Invite Friends<span class="d-none d-md-inline"> &</span><br>
                        Earn Prizes
                    </strong>
                </h1>
            </div>


            <div class="col-12 col-lg-6 d-flex justify-content-center flex-column">
                <p class="mt-3 text-center d-none d-md-block">
                    Share your unique link to Gift Instant Access and Earn Rewards for each friend who takes the negotiated deal.
                </p>
                <p class="mt-3 text-center d-md-none">
                    Don't Leave Your Friends Behind. <br> Share your unique link.
                </p>
                <form>
                    <div class="input-group mt-4">
                        <input
                            type="text"
                            class="form-control text-center"
                            value="{{ url('/?accessCode=' . $affiliate->access_code . '&grow=' . $affiliate->code ) }}"
                            id="unique-url">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary copy-button" type="button" data-clipboard-target="#unique-url">Copy</button>
                        </div>
                    </div>
                </form>
                {{--<h2 class="text-center mt-3">--}}
                    {{--<i class="fab fa-facebook-square facebook-color"></i> | <i class="fab fa-twitter-square twitter-color"></i> | <i class="fab fa-whatsapp whatsapp-color"></i>--}}
                {{--</h2>--}}
            </div>
        </div>


    </div>
</div>
