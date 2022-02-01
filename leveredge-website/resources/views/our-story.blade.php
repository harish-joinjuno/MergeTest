@extends('template.public')

@section('content')

     <div class="container mt-5">
         <div class="row">
            <div class="col-12">
                <h2>Our Story</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <p>
                We thought getting into grad school was the hard part, until that dreaded tuition bill came. Like many others, we started looking at student loan options, and didn’t love the rates being offered.
                </p>
                <p class="mt-3">
                So, we pooled together a few dozen classmates who needed loans and asked local banks if they would give us a bulk discount! We eagerly walked into local bank branches, pitched our proposal, and quickly got… nowhere.
                </p>
                <p class="mt-3">
                    Not ready to give up, we decided to contact more senior decision makers, and cold-emailed the CEOs of banks, fintech companies, and credit unions with the same proposal. To our surprise, many of them replied! Problem was, they wanted way more people involved.
                </p>

                <p class="mt-3">
                So, we tapped every contact we knew, steadily growing the pool to over 700 people! Many of you helped along the way, for which we’ll always be thankful.
                </p>
                <p class="mt-3">
                We ran a competitive bidding process with multiple lenders, negotiated rates and terms, and selected a partner who drove down borrowing costs for the vast majority of people in our group.
                </p>
                <p class="mt-3">
                Now, we’re expanding the pool to cover many more people, improving our ability to reduce rates for students across the country. Will you help us get there?
                </p>
            </div>

            <div class="col-md-4 offset-md-1 mt-4 mt-md-0">

                <div class="card mb-3">
                    <img class="card-img-top" src="/img/ilab-landscape.png">
                    <div class="card-body">
                        <p class="mb-0">Member of the Harvard Innovation Labs Venture Incubation Program</p>
                    </div>
                </div>


                <div class="card mb-3">
                    <img class="card-img-top" src="/img/pear-landscape.png">
                    <div class="card-body">
                        <p class="mb-0">Member of Pear HBS</p>
                    </div>
                </div>


                <div class="card">
                    <img class="card-img-top" src="/img/rock-landscape.png">
                    <div class="card-body">
                        <p class="mb-0">Member of the Harvard Business School Rock Incubator Program</p>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Founding Team</h2>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 justify-content-center align-self-center text-center">
                <img style="max-height: 400px;" src="{{ url('/img/leveredge-team.jpg') }}" class="img-fluid">
                <p>
                    <a href="https://www.linkedin.com/in/abkarians/">Chris Abkarians</a> and <a href="https://www.linkedin.com/in/nikhilagarwal2/">Nikhil Agarwal</a> at the Harvard Innovation Lab
                </p>
            </div>
        </div>
    </div>


    <div class="py-5 my-5"></div>

@endsection
