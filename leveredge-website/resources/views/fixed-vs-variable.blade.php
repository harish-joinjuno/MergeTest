@extends('template.public')


@section('content')


    @hasPageSection(\App\PageSection::PAGE_FIXED_VS_VARIABLE,'Above Graph')
    @php
        $aboveGraphSection = \App\PageSection::query()
                    ->where('target_page', '=', \App\PageSection::PAGE_FIXED_VS_VARIABLE)
                    ->where('section_name', '=', 'Above Graph')
                    ->first();
    @endphp
    @endif

    @hasPageSection(\App\PageSection::PAGE_FIXED_VS_VARIABLE,'Below Graph')
    @php
        $belowGraphSection = \App\PageSection::query()
                    ->where('target_page', '=', \App\PageSection::PAGE_FIXED_VS_VARIABLE)
                    ->where('section_name', '=', 'Below Graph')
                    ->first();
    @endphp
    @endif


    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center off-black">
                    Fixed vs. Variable Loan Rates <br>
                    & How to Decide Which One is Right for You
                </h2>
            </div>
        </div>


        <div class="row mt-5">
            <div class="col-12">
                <p>
                    This year, Juno members applying for graduate loans have the option to take a fixed or variable interest rate. Generally, our members have preferred fixed rate loans—which makes sense most of the time—but this year variable rates are so low that many members may be better off using variable rate loans. This page is meant to help serve as a resource in making your decision. To be clear, we are not a financial advisor and are only here to give you more information to help you make your decision.
                </p>
                <p>
                    Juno has no financial incentive whether you take a fixed or variable rate loan. Either way, you will be getting a great rate. Here are the differences:
                </p>
                <p>
                    <strong>Fixed Interest Rates</strong> are locked in for the life of the loan. They are usually higher than what initial variable interest rates offer, but they are predictable because they will not change with market fluctuations. You might be able to lower a fixed interest rate through student loan refinancing, and many students choose to refinance when the fixed rates drop. For these reasons, historically the majority of students choose a fixed rate loan.
                </p>
                <p>
                    <strong>Variable Interest Rates</strong> are subject to change throughout the life of the loan, but can be substantially lower than fixed rates. Student loan lenders, including our lenders, typically set variable rates based on an economic indicator (index) known as the 1-month LIBOR rate which serves as a “benchmark.” Lenders determine variable rates by adding a “spread” rate to the benchmark LIBOR rate. Your spread rate does not change after you get your loan and is determined by factors such as your credit score, school you attend, riskiness, etc.
                </p>
            </div>

        </div>
    </div>

    <div class="jumbotron bg-translucent-green py-3 my-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <strong>What is the 1-month LIBOR rate?</strong> LIBOR stands for London Interbank Offered Rate. It’s a standard financial index used in the U.S. (published daily in the Wall Street Journal) and represents the interest rate at which banks offer to lend money to each other in the wholesale money markets of London. The LIBOR rate varies as economic conditions change.
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>
                    As the 1-month LIBOR rate changes each month, your variable rate goes up or down accordingly which changes your monthly payment. Keep in mind that lenders can’t control the benchmark, so they can’t change your rates just because they feel like it.
                </p>
                <p>
                    In addition, if the rate starts to climb too high you might be able to refinance and switch to a fixed rate to prevent it from increasing in the future—just be aware that fixed and variable rates often move in the same direction, so your fixed rate will be higher as well.
                </p>
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-12">

                <h2>Which Type of Loan is Right for Me?</h2>

                <p>
                    Now that you understand the difference between your fixed and variable rate options, you want to ask yourself:
                </p>

                <p>
                    How much lower does the variable interest rate need to be, compared to your best fixed interest rate option, to be worth the risk of a fluctuating rate?
                </p>

                <p>
                    In answering this question it is helpful to remember that the answer will change based on how long your repayment term is and if you plan to refinance in the future. For example, if you are a current student taking out a loan and you plan to refinance after graduation (in 1-3 years), the risk of a variable loan lowers considerably. Note that your ability to refinance your loan is not guaranteed.
                </p>

                <p>
                    You should also consider your personal tolerance for that risk and what you think the benchmark will do over time. Right now the benchmark is pretty low at 0.17%, which makes many economists believe that it can only go one direction—up. Even assuming that is true, rates may not increase significantly for a while which means that a variable rate could still save money relative to current fixed rates.
                </p>
            </div>
        </div>
    </div>


    <div class="jumbotron bg-translucent-green py-3 my-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    For more context on <strong>how likely it is for rates to rise in the future</strong>, Jerome Powell, the Chair of the Federal Reserve, signaled that there is no consensus to raise rates until 2023 at the earliest. He recently said, “We’re not thinking about raising rates. We’re not even thinking about thinking about raising rates.” <a target="_blank" href="https://www.wsj.com/video/powell-were-not-even-thinking-about-thinking-about-raising-rates/0C020333-947B-411F-912E-6EF76EFE18C0.html">WSJ</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>
                    For some perspective, here is how 1-month LIBOR rates and the Effective Federal Fund rates have changed from 2009-2020:
                </p>

                <div class="my-5">
                    <img src="{{ asset('img/federal-fund-and-libor-rates.png') }}" class="img-fluid">
                </div>

                <p>
                    <strong>In Summary</strong>, variable interest rates will likely be significantly cheaper than fixed interest rates on the day of your application and could save you money over the life of your loan, depending on how benchmark rates change in the coming years. Although in the past variable rates have been less popular than fixed rates, 2020 has presented lenders with historically low variable interest rates, and choosing a variable rate today may be your best option. Before deciding however, you should consider your personal tolerance for risk, know that you might be able to refinance to a fixed rate later (albeit at a higher rate), and understand your payment could go up or down over the years if you don’t choose a fixed rate.
                </p>

                <p>
                    For reference, here is how federal student loan interest rates have changed from 2006-2020
                </p>

                <div class="my-5">
                    <img src="{{ asset('img/federal-rates-2006-2021.png') }}" class="img-fluid">
                </div>

            </div>
        </div>
    </div>

    @hasPageSection(\App\PageSection::PAGE_FIXED_VS_VARIABLE,'Above Graph')
    <div class="container">
        <div class="row">
            <div class="col">
                {!! $aboveGraphSection->published_content !!}
            </div>
        </div>
    </div>
    @endif


    @hasPageSection(\App\PageSection::PAGE_FIXED_VS_VARIABLE,'Below Graph')
    <div class="container">
        <div class="row">
            <div class="col">
                {!! $belowGraphSection->published_content !!}
            </div>
        </div>
    </div>
    @endif


    <div class="py-5"></div>

@endsection
