@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@section('content')

    <div class="jumbotron bg-translucent-green pb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-3 text-center">
                    <img
                        src="{{ asset('/img/logo/juno-logo.png') }}"
                        alt="Juno Logo"
                        class="img-fluid"
                    >
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 py-5 text-center">
                    <h1 class="mb-3" style="color: #333">LeverEdge is now Juno!</h1>
                    <h5 class="fw-400">Same concept, same team, just with <span class="fw-600">an easier-to-spell name</span>.</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 py-5">
                    <h2 class="text-center mb-2">Why did we change our name?</h2>
                    <h5 class="mb-0 text-center">For one reason only – to make it easier to share.</h5>
                    <p class="mt-5">
                        Most of our members find out about us through word-of-mouth. That’s how we’re able to keep LeverEdge free,
                        increase trust, and deliver the best deals in student financing.
                    </p>
                    <p>
                        We love LeverEdge, and we won’t lie – we’re pretty attached to the name. But even our core team has
                        some disagreement over how it’s pronounced (see evidence below).
                    </p>

                    <div class="embed-responsive embed-responsive-16by9 mt-5">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/vqALo_P0IYE?rel=0" allowfullscreen></iframe>
                    </div>

                    <p class="mt-5">
                        So, we spent the past few months trying new concepts and testing new names to find
                        something easier to say and faster to share (with an available domain name).
                    </p>
                    <p>
                        Jokes aside, we will miss the name LeverEdge dearly. When you associate so much of yourself with a name
                        for two years, it is hard to imagine going by anything else.
                    </p>
                    <p>
                        But, we built this company to solve problems for others and to find ways to make collective bargaining
                        more mainstream. Graduating to Juno will help us accelerate those goals, and we couldn’t be more excited
                        about what’s ahead.
                    </p>
                    <p>
                        If you’re curious to learn more about the genesis of Juno, and a little history on our old name(s),
                        we hope you’ll enjoy the read below:
                    </p>

                    <h2 class="mt-5 text-center  mb-2">How we came up with Juno</h2>
                    <h5 class="text-center">Pop quiz. How many names has this company had?</h5>


                    <h6 class="mt-5 fw-600">Name 1: MBA Loan Negotiation Group</h6>
                    <p>
                        In May 2018, we started off as a Facebook group called the ‘MBA Loan Negotiation Group’.
                        700 students joined us in what was then just an experiment to see if we could negotiate a discount on
                        our own student loans.
                    </p>
                    <p>
                        It was descriptive and accurate, but at 23 letters and 4 separate words, just doesn’t quite roll
                        off the tongue.
                    </p>

                    <h6 class="mt-5 fw-600">Name 2: Brokr</h6>
                    <p>
                        Three months later, we applied to an accelerator and changed our name to ‘Brokr’ -
                        you know, like broker, without an ‘e’
                    </p>
                    <p>
                        The person who read that application politely suggested we try something different.
                    </p>
                    <p>
                        Needless to say, she was right. And now, she’s our Chief of Staff.
                    </p>

                    <h6 class="mt-5 fw-600">Name 3: LeverEdge</h6>
                    <p>
                        For the past 2 years, over 25,000 of you have come to know us as LeverEdge!
                    </p>
                    <p>
                        How did we get there? We wanted to create a new word that was memorable, and just as importantly,
                        one that had an available domain name.
                    </p>
                    <p>
                        Leverage is what you get when you join together to negotiate as a group. Our business model gives
                        our members an <span class="fw-600">Edge</span>. So, mash it together, throw a .org on the end, and you get name #3!
                    </p>
                    <p>
                        For a startup created by two MBA students, we considered this a feat of creative inspiration.
                        We...then ran into many interesting pronunciations and spellings of our name and realized we hadn’t
                        considered ease of pronunciation or spelling.
                    </p>

                    <h6 class="mt-5 fw-600">Name 4: Juno</h6>
                    <p>
                        How do you change a name after two years?
                    </p>
                    <p>
                        We started with a shared Google doc between team members and threw in any ideas people had.
                    </p>
                    <p>
                        After a few weeks, we got to 41 possibilities. Some were great. Most were embarrassingly bad*.
                    </p>
                    <p>
                        But, it got the creative juices flowing, and we soon narrowed that down to eight final contenders.
                    </p>
                    <p>
                        Next, we embarked on a four-week proprietary selection process that we learned at Harvard Business
                        School**. And finally, we landed on Juno because it met every key objective... and because we could buy
                        <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer">joinjuno.com.</a>
                    </p>

                    <p>
                        * If you refer 100 friends, Chris will send you the full list.<br>
                        **(we polled people using thumbs up and down emojis)
                    </p>

                    <h6 class="mt-5">
                        Thank you for your continued support,<br>
                        - Team Juno
                    </h6>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5"></div>
@endsection
