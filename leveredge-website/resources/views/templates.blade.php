@extends('template.public')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Thank you so much for wanting to share! We appreciate your help in growing our negotiating pool; this will help everyone save money in the long run. </h2>
            </div>
            <div class="col-12 col-md-8">
                <h2>Posting Advice:</h2>
                <ul>
                    <li>Use our graphics: we want to make your life easier.</li>
                    <li>Keep the message simple: feel free to share our <a href="{{ url('member/referral-program') }}">website</a> so people can access more information. We also provided some ideas below to help you out! </li>
                    <li>Put us everywhere: Facebook groups, Twitter, Instagram stories, your mom’s WhatsApp family chat, share us everywhere you think people need to save money! As a reminder, we help undergraduate and graduate students, along with alumni who want to refinance their loans.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <h2>General Copy</h2>
                <p>
                    Need help paying for school? Juno negotiates lower student loan rates for their members using
                    group buying power. So far they’ve saved students more than $26,000,000 in interest and fees and
                    they’ve just announced their latest negotiated deals! Signing up to get access to the deal only takes
                    a minute: [your referral link, which you can find <a href="{{ url('member/referral-program') }}">here</a>.]
                    If you have any questions, feel free to reach out to their team at <a href="mailto:hello@joinjuno.com">hello@joinjuno.com</a>.
                </p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <h2>MBA/Graduate Copy</h2>
                <p>
                    Juno just finished their negotiations and has a deal for us! You can access it by signing up
                    through my link. There’s no obligation to actually take the deal. You’ll be free to decide whether it
                    makes sense for you. Access the deal here: [your referral link, which you can find
                    <a href="{{ url('member/referral-program') }}">here</a>.] If you have any questions, feel free to
                    reach out to their team at <a href="mailto:hello@joinjuno.com">hello@joinjuno.com</a>.
                </p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <h2>Undergraduate Copy </h2>

                <p>
                    Student loans can be a little scary, so I decided to join Juno, an organization trying to make
                    them a little easier to understand. Basically, they get a huge group of students & families together
                    and ask lenders to compete with a bulk discount, saving everyone money. Federal loans typically have
                    better rates for undergrads, but if you need more than the federal borrowing limit, then Juno
                    can offer a discount on the private loans you’d need. Joining is free and there’s no obligation to
                    actually take the deal they’ve negotiated! Signing up only takes a minute: [your referral link,
                    which you can find <a href="{{ url('member/referral-program') }}">here</a>.] If you have any questions, feel free to reach out to their team at <a href="mailto:hello@joinjuno.com">hello@joinjuno.com</a>.
                </p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2>Right-click to download the images! </h2>
            </div>
        </div>
    </div>


    <div class="row text-center">
        <div class="col-4">
            <img width="250px" src="{{ asset('img/templates/referral_asset_1.png') }}" />
        </div>
        <div class="col-4">
            <img width="250px" src="{{ asset('img/templates/referral_asset_2.png') }}" />
        </div>
        <div class="col-4">
            <img width="250px" src="{{ asset('img/templates/referral_asset_3.png') }}" />
        </div>
    </div>

    <div class="row text-center">
        <div class="col-6">
            <img width="250px" src="{{ asset('img/templates/referral_asset_4.png') }}" />
        </div>
        <div class="col-6">
            <img width="250px" src="{{ asset('img/templates/referral_asset_5.png') }}" />
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <h2>How to Talk About Us:</h2>
                <ul>
                    <li>Send an Email</li>
                    <li>Post on Instagram</li>
                    <li>Post on Facebook</li>
                    <li>Post in a Facebook Group</li>
                    <li>Post on Twitter</li>
                    <li>Post on LinkedIn</li>
                    <li>Post on Reddit</li>
                    <li>Send a Message in Your Cohorts…</li>
                    <ul>
                        <li>Group Me</li>
                        <li>WhatsApp Chat</li>
                        <li>Facebook Messenger Group Chat</li>
                        <li>Slack Group Chat</li>
                        <li>Discord Group Chat</li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>

    <div class="py-5"></div>

@endsection
