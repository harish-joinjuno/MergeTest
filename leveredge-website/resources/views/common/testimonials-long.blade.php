@php

$large_testimonials = [

"I'm sure you get a lot of mail, but I just wanted to extend a thank you for everything Juno has done this summer. The deal I was offered blew all of my other options completely out of the water, and is saving me thousands of dollars. Almost more importantly, the process was painless, communication with participants was outstanding, and Juno is substantially reducing the stress involved in a major career transition. Best of luck with the rest of your endeavors.",


"For those of you that know me - you've probably heard me complain about my student loans once or twice The amount of debt we take on when we are young can be crazy and at that age I didn't really understand the implications of going into debt before even having a graduate degree On top of that I don t think I even looked at the interest rates I was taking on and how much of a monthly payment I was committing to. I'm sure many of you share my pain, because as we read about all the time, this is a huge issue in our country
<br><br>
I randomly learned about a company called Juno a couple months back - it's mission is to help bundle outstanding student loans and using the power of numbers help borrowers refinance and get better interest rates. I was skeptical - I've looked at refinancing and it often turns out to be too good to be true Even so I signed up to be included in their next negotiation and waited a couple months to see what happened
<br><br>
For me what happened is a small miracle They negotiated a deal with Earnest a well known lender that took my interest rate down over 7%. My monthly payment actually decreased a little, and I will be paying off my debt more than 7 years earlier than I d been scheduled I can still prepay my loan without penalty and am saving tens of thousands in interest
<br><br>
I can t say whether this will help you or a loved one and it's really important to understand your debt whether refinancing or borrowing, because every situation is unique But it's something I highly recommend looking into and thought I'd put out there, because this is a really widespread problem that I don't think we can solve without getting creative and finding solutions like Juno has
<br><br>
Xoxo",

"I initially went with SunTrust ... I sadly got a 6.7 rate ... I just got my order from Juno and it's 4.475! I emailed financial aid and they were able to cancel my SunTrust loan to swap it out. Get a second opinion by them, you still have time!",

"For 1Y/2Ys, Juno also does deals for student loans through Laurel Road. Going through them actually gets you a significantly lower interest rate - with a good credit score you can get a loan well under 5%. It's been the best rate I've found thus far for 2Y and wish I had known about it my first year.",

"It was really easy to apply and see the rates, and they were lower than what I got from other lenders that approved me (not all lenders approved as they seemed to be seeking proof of income, and I'm a full time student without one.",


];

$small_testimonials=[

"The deal I was offered blew all of my other options completely out of the water, and is saving me thousands of dollars",

"I initially went with SunTrust ... I sadly got a 6.7 rate ... I just got my order from Juno and it's 4.475!",

"I've applied for over 20 loans last year, and this one gave me the best interest rate and flexibility on repayment terms.",

"I just got the Juno rates. Way better than anything else I could find! Ended up closing on 5%.",

"Rates are way better than the federal loans. Definitely recommend checking it out.",

"Juno was my best option (for the second year in a row.)",

"Beat my next best offer by at least a full percentage point (for similar terms).",

"I wish I had known about this coming into my first year, and am really happy with my low rate and how easy it is!",

"I had applied for loans through Laurel Roads and got 5.3%+ offers then re-applied with Juno and got 4.7% rates (also through Laurel Roads).",

"I did the Juno process (group negotiating) and the lender is Laurel Rd and my rate options are mostly in the 4/s.",

"I just got my loans through Juno. Their rate beat every other private lender that I had considered including the federal options.",

"I just secured my first year MBA loan for 5.535% fixed over 15 years using Juno.",

"I spent a lot of time researching, and their deal rate was better than what I found via other private lender apps or fedgov.",

"This is the group that negotiated lower rates (a whole point lower) last year. It’s free to sign up and non-binding.",

"It was definitely the lowest rate I found across a bunch of different lenders so just thought I'd share here!",

// Old Testimonials

"Thanks a lot for doing this!! For me, it made a huge difference from 8-9% to 5-6%.",

"Thanks! Beat my Sallie Mae by 0.5% but doesn't require monthly payments.",

"Thanks all I just secured my loan for 5.5% beating CommonBond by an entire 1%. Thanks.",

"The negotiated interest rate was so much better than the rates offered by other lenders.",

"Fantastic idea. Wish my wife had it for law school",

"It was good. I would do it for my next loan, especially if I knew about it sooner.",

"I was able to get a cheaper private loan compared to the federal loans I would have had to utilize instead.",

"Being able to collectively bargain given our unique school status / rank",

"superb! This was by far the best rate I received. The process was very simple and I would do it next year 100%" ,

"Regular communication to keep us updated was very helpful - Low rate!",
];

@endphp

<section id="testimonials">

    <div class="container">


    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Reviews</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h4 class="mb-3">Here are some reviews back when our name was LeverEdge. Don’t worry – that’s the only thing that’s changed.</h4>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/dxg-wPZgu5M" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/2Mt0eP_HWuc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Afsb5dD44_c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($small_testimonials as $testimonial)
                <div class="col-lg-4 col-12">
                    <div class="card mt-4">
                        <div class="card-body text-center">
                            <img src="{{ url('/img/icons/testimonial-quote-icon.png') }}" height="70px" class="mt-4">
                            <p class="card-text mt-5">{{ $testimonial }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-12">
                <p class="mt-5">
                    All reviews shown are based on:
                </p>
                <ol>
                    <li>Responses to a survey completed in Fall 2018</li>
                    <li>Posts in the Juno Members Facebook Group</li>
                    <li>Posts Members Have Made on Social Media or within Private Chat Groups</li>
                </ol>

            </div>

        </div>
    </div>

</section>
