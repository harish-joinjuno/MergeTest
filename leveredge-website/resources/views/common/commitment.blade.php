<!-- The Juno Commitment -->
<div class="container" id="commitment">
    <div class="row">
        <div class="col-md-12">
            <h2>The Juno Commitment</h2>
            <div class="separator"></div>
            <p class="mt--3">TLDR: Juno is not a lender. We are on the student's side and actually students ourselves.</p>
        </div>
    </div>

    <div class="row mt-md-5 mt-0">

        <div class="col-12 col-md-6 mt-4 mt-md-0">
            <div class="row">
                <div class="col-2 text-right pr-0">
                    <img src="{{ url('/img/commitment-icons/savings.png') }}" height="50">
                </div>
                <div class="col-10">
                    <h4>Free for Students</h4>
                    <p>
                        We don't charge any fees to students for participating in our negotiating groups.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4 mt-md-0">
            <div class="row">
                <div class="col-2 text-right pr-0">
                    <img src="{{ url('/img/commitment-icons/interest-rate.png') }}" height="50">
                </div>
                <div class="col-10">
                    <h4>Better Terms and Rates</h4>
                    <p>
                        We ask lenders to offer better rates and terms than those already broadly available to you.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-0 mt-md-5">

        <div class="col-12 col-md-6 mt-4 mt-md-0">
            <div class="row">
                <div class="col-2 text-right pr-0">
                    <img src="{{ url('/img/commitment-icons/peer-to-peer.png') }}" height="50">
                </div>
                <div class="col-10">
                    <h4>Support from your Peers</h4>
                    <p>
                        When you join Juno, you enter the Juno community. You'll join a Facebook Group where you can expect quick responses from us and other students in the program.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4 mt-md-0">
            <div class="row">
                <div class="col-2 text-right pr-0">
                    <img src="{{ url('/img/commitment-icons/calculator.png') }}" height="50">
                </div>
                <div class="col-10">
                    <h4> Helpful Calculators</h4>
                    <p>
                        Need help deciding? Our unbiased calculator can help you understand the difference between an option we negotiate and the many others available to you.
                    </p>
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
