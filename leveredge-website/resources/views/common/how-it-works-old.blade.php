<!--==========================
          About Section
        ============================-->
<div class="container" id="how-it-works">
    <div class="row">
        <div class="col-md-12">
            <h1 class="section-title text-left text-lg-center">How It Works</h1>
            <h2 class="section-intro text-left text-lg-center">We use group buying power to negotiate down your interest rate with lenders.</h2>
        </div>


        <div class="col-12 how-it-works-mobile d-lg-none">
            <div class="mobile-step">
                <h4 class="title"><a data-toggle="collapse" href="#stepOne" role="button" aria-expanded="false" aria-controls="stepOne" class=""><i class="fas fa-chevron-down"></i>Students Sign Up</a></h4>
                <p class="description collapse show" id="stepOne">Students join a Juno Negotiation Group for free. Just provide your name and email address.</p>
            </div>
            <div class="mobile-step">
                <h4 class="title"><a data-toggle="collapse" href="#stepTwo" role="button" aria-expanded="false" aria-controls="stepTwo" class=""><i class="fas fa-chevron-down"></i>Lenders Compete</a></h4>
                <p class="description collapse show" id="stepTwo">We ask lenders to submit their proposed loan terms for students in the group. We evaluate and select one offer to share with students.</p>
            </div>
            <div class="mobile-step">
                <h4 class="title"><a data-toggle="collapse" href="#stepThree" role="button" aria-expanded="false" aria-controls="stepThree" class=""><i class="fas fa-chevron-down"></i>Loans Offered</a></h4>
                <p class="description collapse show" id="stepThree">Students apply directly to the lender via our unique link to get the negotiated interest rates and terms!</p>
            </div>
        </div>


        <div id="how-it-works-steps" class="d-none d-lg-block">

            <div class="col-lg-12">

                <div class="card-deck">

                    <div class="card border-0">
                        <div class="card-body">
                            <div class="step">
                                <h3 class="step-number">Step 1</h3>
                                <h4 class="title">Students Sign Up</h4>
                                <p class="description">Students join a Juno Negotiation Group for free. Just provide your name and email address.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0">
                        <div class="card-body">
                            <div class="step">
                                <h3 class="step-number">Step 2</h3>
                                <h4 class="title">Lenders Compete</h4>
                                <p class="description">We ask lenders to submit their proposed loan terms for students in the group. We evaluate and select one offer to share with students.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0">
                        <div class="card-body">
                            <div class="step">
                                <h3 class="step-number">Step 3</h3>
                                <h4 class="title">Loans Offered</h4>
                                <p class="description">Students apply directly to the lender via our unique link to get the negotiated interest rates and terms!</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <!-- Get Started Button -->
            @if(isset($call_to_action_link) && isset($call_to_action_text))
                <div class="row">
                    <div class="col-lg-12 text-center get-started-button">
                        <a href="{{ $call_to_action_link }}" class="btn btn-primary btn-lg">{{ $call_to_action_text }}</a>
                    </div>
                </div>
            @endif

        </div>

    </div>








</div>
