@extends('template.public')


@section('content')
    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center off-black">Variable Rates</h2>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h3>How do variable rates work?</h3>
                <p>
                    Variable Interest Rates can change throughout the life of your loan, but can be lower than fixed rates.
                </p>
                <p>
                    When you get a variable student loan quote, it is structured as <strong>LIBOR + Spread.</strong>
                </p>
                <ul>
                    <li>
                        <p>
                            <strong>LIBOR</strong> (London Interbank Offered Rate) is a standard financial index published daily in the Wall Street Journal. It represents the interest rate at which banks offer to lend money to each other in the wholesale money markets of London.
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Spread</strong> is the amount above LIBOR that the lender charges you for your loan, based on your credit score and other risk factors. This is a fixed number and <strong>does not change.</strong>
                        </p>
                    </li>
                </ul>
                <p>
                    The only thing that changes the cost of your variable rate loan is changes to the LIBOR index. Monthly payments under this type of rate are not constant. Payments will decrease when the LIBOR goes down and will increase when it rises.
                </p>
                <p>
                    Below is a chart from 6/12/2020. It shows  the market’s projection for how 1-Month LIBOR will change over the next decade.
                </p>
                <p>
                    The median projection is for LIBOR to remain very low, sub-1% for most of the decade.
                </p>
                <div>
                    <p>In our calculator <i class="fas fa-question-circle ml-2"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Using the free calculator is for informational purposes only, does not constitute an offer to receive a loan, and will not solicit a loan offer. Any payments shown depend on the accuracy of the assumptions and the information provided."></i>
                    </p>
                    <ul>
                        <li><strong>“Base Case”</strong> is the “Market Projections” line below</li>
                        <li><strong>“Aggressive”</strong> case is 1 Standard Deviation higher than the median expected outcome</li>
                        <li><strong>“Very Aggressive”</strong> case is 2 Standard Deviations higher than the median expected outcome</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <img src="{{ asset('/img/variable-forecast.png') }}" class="img-fluid" />
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <p>Note that there are people in the market who believe LIBOR will go negative as well. We are choosing not to show Standard Deviations below the Median projections so we can be conservative.</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h4 style="text-decoration: underline">Notes</h4>

                <p>To project the LIBOR rate into the future we used two sources: 1) Pensford for the rates between june 2020 and may 2030. 2) Bloomberg LP, from june 2030 onwards.</p>

                <p>To project LIBOR rates, we use the market implied forward rates</p>

                <p>These rates are the market implied predictions for the LIBOR rate at some point in the future. These are calculated using the swap curve as benchmark and comparing rates for different tenors. For example, if the current 3-month LIBOR rate is 2% and the 6-month LIBOR rate is 3%, the forward implied rate for the 3-LIBOR in 3 months is ~4%</p>

                <p>(1+2%)(1/4)*(1+x%)(1/4) = (1+3%)(1/2); x% = 4.01%</p>

                <p>In practice, the actual LIBOR could be different than the market implied rate.</p>
            </div>
        </div>
    </div>

    <div class="py-5"></div>

@endsection
