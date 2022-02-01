@extends('template.base')

@push('header-scripts')
    <link href="{{mix('mix/css/styles.css')}}?ver=1.1" rel="stylesheet" type="text/css">
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@section('base-content')
    @if(request()->has('utm_source') && request()->get('utm_source') === 'facebook')
        @include('landing-pages.partials._simple-nav')
    @else
        @include('template._main-nav')
    @endif

    <div
        class="container mb-n4 py-5"
        style="background:url({{ asset('/img/students-both-sides-bg.png') }}) bottom center / contain no-repeat;z-index:2;position:relative;"
    >
        <div class="row align-items-center mt-5">
            <div class="col mb-5">
                <h1 class="off-black">
                    Juno helps Temple students save thousands on their student loans
                </h1>
            </div>
            <div class="col-12 col-sm-auto mb-sm-0 text-center">
                <img
                    src="{{ asset('/img/temple-logo.png') }}"
                    alt="Temple Logo"
                    style="max-width:200px;height:auto;"
                >
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col p-5 text-left mb-5">
                        <h3 class="h2-class off-black">Did you know that:</h3>
                        <ul class="text-dark">
                            <li>Federally held student loans don’t cover everyone’s financial need</li>
                            <li>1 out of 6 Temple students take out private loans</li>
                            <li>The avg. student borrows $18,425 per year from private lenders</li>
                        </ul>


                        <h6 class="text-dark">
                            If Temple students join together, you could get lenders to provide student loan discounts.
                            In fact, reducing rates by 1%, would save Temple $17M! Learn more below.
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-center text-muted font-semibold">
            ~ 3 minute read below
        </p>
    </div>

    <div class="container-fluid bg-light-green py-5">
        <div class="container">
            <h2 class="mb-4 text-center text-primary mb-5">
                Why does saving 1 percent on my rate matter?
            </h2>

            <div class="row align-items-center">
                <div class="col-12 col-md-6 order-md-2 mb-4">
                    <img
                        src="{{ asset('/img/temple-chart.png') }}"
                        alt="Interest Charge on avg. Temple Private Loan"
                        class="img-fluid"
                    >
                </div>
                <div class="col-12 col-md-6">
                    <p class="font-semibold mb-0">
                        The APR on your student loan can have a massive impact on the amount you have to pay back.
                        <br><br>
                        The average Temple Freshman borrows $18,425 from private lenders.
                        <br><br>
                        <strong class="text-primary">
                        Dropping your rate from 9% to 8% would save you nearly $3,000 over the life of your loan.
                        </strong>
                        <br><br>
                        Most families don’t even think to shop around for better rates. That’s exactly what lenders
                        hope you will do! And that’s where we come in.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light py-5">
        <div class="container narrow px-0 my-5">
            <div class="row">
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Welcome to Juno</h4>
                    <p>
                        The first collective bargaining group for students, by students!  We gather large groups of
                        students who need loans and get banks to compete for our business.
                        <br><br>
                        Since launching at Harvard, we’ve grown to 41,000 members on over 100 campuses.
                        <br><br>
                        Joining Juno is fast and free and it does not obligate you to take a loan! We’ll just keep
                        you in the loop on the deals that we negotiate with lenders.
                        <br><br>
                        In fact, our most recently negotiated deals with lenders include a 1% rate reduction,
                        which you won’t see anywhere else.
                    </p>
                    <div class="text-center">
                        <a
                            href="{{ url('/register') }}"
                            class="btn btn-secondary rounded-pill px-5 flashing-button font-weight-bold"
                        >
                            Join Now
                        </a>
                    </div>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Why you should trust us</h4>
                    <p>
                        We started Juno a few years ago when we were shopping around for loans for Harvard Business
                        School. Since then, we’ve been immersed in the student loan industry, regularly speaking
                        with key players nationwide.
                        <br><br>
                        This year, we ran an auction, making all the lenders offer the best rates to our community.
                        In the process, we pored over dozens of rate tables, and stayed up all night crunching
                        spreadsheets to map out which lenders offered the most people the best rates.
                        <br><br>
                        Since our members never pay us, we charge all the lenders a set fee that is agreed before
                        the negotiations begin. That way, we can’t be swayed by a larger financial incentive.
                        The only way to win the auction is to offer our community the best rate.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Our Track Record</h4>
                    <p>
                        Juno is the only organization that has successfully negotiated discounts for student
                        loans on behalf of large groups of students. We’ve helped students and families borrow
                        more than $200M at discounted rates. Additionally, our cash back deals have given more
                        than $502,121 back to our members. Over 40,000 members have trusted Juno to negotiate
                        more affordable student loans for them.
                    </p>
                    <div class="text-center">
                        <a
                            href="{{ url('/register') }}"
                            class="btn btn-secondary rounded-pill px-5 flashing-button font-weight-bold"
                        >
                            Join Now
                        </a>
                    </div>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">By the numbers</h4>
                    <ul>
                        <li class="mb-2">
                            41,000+ members
                        </li>
                        <li class="mb-2">
                            $502,121+ in cash back earned by our community in 2020
                        </li>
                        <li class="mb-2">
                            $26,000,000+ in savings compared to federal rates
                        </li>
                    </ul>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">How we save you money</h4>
                    <p>
                        Lenders spend so much money on marketing. This year, SoFi spent 400 million dollars on the
                        naming rights to a stadium. All those costs get passed along to borrowers in the form of
                        higher interest rates.
                        <br><br>
                        Instead, we pitch lenders an alternative: give our members better rates and avoid spending
                        thousands of dollars per customer on marketing. It saves them time and money, and we end up
                        getting our community better rates for free.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Who this is for?</h4>
                    <p>
                        For undergraduate students, those who need to borrow above the federal lending limit
                        can save money using our deals as an alternative to Parent PLUS loans. We currently have
                        a student loan deal with an exclusive rate discount that can help families bridge the gap
                        after they’ve hit the federal lending limit.
                        <br><br>
                        If you’re an international student, we are continuing our efforts to negotiate better
                        student loan options for you. For now, we have a student health insurance deal for
                        international students that can save you thousands.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Do I need a co-signer? What does that mean?</h4>
                    <p>
                        A co-signer is a person who is obligated to pay back the loan if you, the student,
                        cannot make your payments. The co-signer can be a spouse, relative, parent or any adult
                        that is a U.S. Citizen or Permanent Resident. We expect undergraduate students will need
                        a co-signer.
                        <br><br>
                        For international students as well as DACA recipients and Conditional Permanent Residents,
                        having a U.S. Citizen/Permanent Resident co-signer may make you eligible for a loan with a
                        U.S. lender. Policies and requirements vary by lender.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">How does this compare to Parent PLUS?</h4>
                    <p>
                        As a reminder, Federal Stafford loans likely offer better options to undergrads, but it’s
                        very common that students need to borrow more than that federal limit ($5,500 for the
                        first year, etc).
                        <br><br>
                        Juno’s deal is best used for the remainder of financial need, and can be used in lieu of a
                        Parent PLUS loan (5.3% for 2020-2021 with a 4.248% origination fee) which can be more
                        expensive than a private loan.
                        <br><br>
                        In comparison, the member you’ll hear from below got a 5.04% interest rate without any fees.
                        That’s the difference of $1,479.89 – $32,643.6 through Juno versus $34,123.49 through Parent
                        PLUS.<sup class="foot-note-marker">*</sup>
                    </p>
                </div>
                <div class="col-12">
                    <h4 class="green-underline mb-4">Hear from a member!</h4>
                    <p>
                        <em>
                            “I just wanted to let you know, after 4 years of applying for private student loans,
                            going through [Juno was] by far was the easiest, fastest, and smoothest, process... It
                            was the easiest application and fool-proof. Every year it is a stressful process filling
                            out all those private loan applications, but this was the best.
                            <br><br>
                            He/we ended up getting a fixed rate of 5.04%, payable starting 9 months after he
                            graduates, payable over 10 years.
                            <br><br>
                            Thank you again!
                            <br><br>
                        </em>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container narrow text-center my-5">
            <svg
                width="54"
                height="54"
                viewBox="0 0 54 54"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="mb-4"
            >
                <path d="M27 0C12.09 0 0 12.09 0 27C0 41.91 12.09 54 27 54C41.91 54 54 41.91 54 27C54 12.09 41.91 0
                27 0ZM32.74 43.83L27 43.84V43.82V43.84C27 43.84 21.39 44.5 18.34 41.45C15.29 38.4 15.95 32.79 15.95
                32.79C15.95 32.79 21.56 32.13 24.61 35.18C26.29 36.86 26.85 39.32 27 41.19V37.96H27.01C27.17 34.58
                30.31 31.98 33.87 32.76C35.96 33.21 37.64 34.9 38.09 36.99C38.86 40.58 36.18 43.75 32.74 43.83ZM38.22
                27C38.22 30.1 35.71 32.61 32.61 32.61C29.51 32.61 27 30.1 27 27C27 23.9 29.51 21.39 32.61 21.39C29.51
                21.39 27 18.88 27 15.78C27 14.81 27.25 13.9 27.68 13.11C28.63 11.36 30.48 10.17 32.61 10.17C34.74
                10.17 36.59 11.36 37.54 13.11C37.97 13.91 38.22 14.82 38.22 15.78C38.22 18.88 35.71 21.39 32.61
                21.39C35.71 21.39 38.22 23.9 38.22 27Z" fill="#444444"/>
            </svg>

            <h4 class="off-black mb-2">Got questions?</h4>
            <p>
                Drop us a line at
                <a
                    href="mailto:hello@joinjuno.com?subject=Question+About+Juno"
                    target="_blank">
                    hello@joinjuno.com.
                </a>
            </p>
        </div>
    </div>

    @push('custom-disclaimers')
        <p class="text-footer-disclaimer">
            *using a loan amount of $25,600 (average for Parent PLUS) over ten years. Additional terms apply.
        </p>
    @endpush
    @include('template._footer')
@endsection
