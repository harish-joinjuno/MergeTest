@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@push('footer-scripts')
    @include('landing-pages.partials._slide-fade-observer')
@endpush

@section('content')
    @include('landing-pages.partnerships._partnership-header', [
        'partner' => $partner,
    ])

    <div class="container narrow my-5 py-5">
        <h1 class="text-center">
            We use group buying power to negotiate better student loan rates.
        </h1>

        @include('landing-pages.partials.home._home-cta', [
            'description' => 'Rates negotiated exclusively for members start at 1.24% APR
            <sup class="foot-note-marker">1</sup>'
        ])
    </div>

    @include('landing-pages.partials._press-banner')

    @include('landing-pages.partials.home._how-it-works')

    <div class="container-fluid bg-light py-5">
        <div class="container narrow px-0 my-5">
            <div class="row">
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Summary (TL;DR)</h4>
                    <p>
                        Join us for free to access exclusive cash back deals on refinancing on top of some of the
                        best rates on the market. We give you more cash back than if you went to the same lenders
                        directly– get up to $1000 in your pocket and reduce your interest rate!
                        <br><br>
                        What does cash back mean? Think of it like a signing bonus– when you sign with one of
                        our partners, you get paid by the lender, us, or both, on top of some of the lowest rates
                        on the market. No strings attached, and
                        <strong>you won't get that extra cash anywhere else.</strong> We’ll pay you to save money on
                        your student loan payments.
                    </p>
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
                        Since members of the community never pay us, we charge all lenders a set fee that is
                        agreed before the negotiations begin. That way, we can’t be swayed by a larger financial
                        incentive. The only way to win the auction is to offer our community the best rate.
                    </p>
                </div>

                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Our Track Record</h4>
                    <p>
                        Juno is the only organization that has successfully negotiated discounts for student loans
                        on behalf of large groups of students. We’ve helped students and families borrow more than
                        $200M at discounted rates. Additionally, our cash back deals have given more than $502,121
                        back to our members. Over 30,000 members have trusted Juno to negotiate more affordable
                        student loans for them.
                    </p>
                </div>

                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">By the numbers</h4>
                    <ul>
                        <li class="mb-2">
                            40,000+ members
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
                    <h4 class="green-underline mb-4">Who is this for?</h4>
                    <p>
                        Refinancing is great for people with high interest student loans, especially private.
                        Right now, those with federally held student loans aren’t incurring any interest until at least
                        October 1st, 2021. As a result, borrowers of those loans are largely waiting until then
                        before considering refinancing, but we welcome you to join now and we will remind you when
                        it’s time to think about refinancing.
                        <br><br>
                        For private loan borrowers, there’s little downside associated with refinance, and a
                        large potential upside in terms of savings, such as reducing your monthly payment.
                    </p>
                </div>

                <div class="col-12">
                    <h4 class="green-underline mb-4">Hear from a member!</h4>
                    <p>
                        <em>
                            “I was with Sallie Mae and my interest rate was 10.75%, but i refinanced with Earnest
                            through [Juno] and not only got my rate down to almost 4%, but I also got $1000 cash.
                            <br><br>
                            I got paid. To save money.
                            <br><br>
                            So make sure as soon as you graduate and get your first paystub to refi. It's super easy and
                            literally takes under 10 minutes, the hardest part is typing in how much you have saved in
                            all our accounts to prove assets as well as entering your social.
                            <br><br>
                            Their system literally automates all the hard parts out of it. Not everyone will save as
                            much as me because I'm kind of an extreme case.
                            <br><br>
                            I refinanced 170k at 10.75%V to 4.04%F, cutting my monthly payment from $2800 to $1250.
                            This is totally free and you can still write off payments on your taxes. Hope this helps
                            someone...
                            <br><br>
                            Of course, make sure you do plenty of research and ask tons of questions to the lender
                            before you refinance any debt.
                            <br><br>
                            I applied for refi literally everywhere and this was the best deal by like 1.2% and was
                            much easier to fill out the app than at other places.”
                            <br><br>
                        </em>
                        - Josh C.
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
@endsection
