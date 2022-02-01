@extends('template.public')



@section('content')

    <main id="main">

        <div class="container mt-5">

            <div class="row">
                <div class="col-12">
                    <h2 class="text-center text-md-left">Our Track Record</h2>
                    <div class="separator mx-auto mx-md-0"></div>
                </div>
            </div>

            <div class="row mt--3">
                <div class="col-12 col-md-6 text-center text-md-left my-md-auto">
                    <h4>Our members have saved over $40M in cumulative interest and fees.</h4>
                    <p class="d-none d-md-inline">
                        <a data-toggle="collapse" data-target="#collapseHowWeCalculateThis" aria-expanded="false" aria-controls="collapseHowWeCalculateThis" href="#collapseHowWeCalculateThis">Learn more about how we calculate this.</a>
                    </p>
                </div>

                <div class="col-12 col-md-6 text-center mt-4 mt-md-0">
                    <img class="img-fluid" src="{{ url('/img/member-savings.svg') }}">
                </div>
            </div>

            <div id="collapseHowWeCalculateThis" class="collapse">
                <div class="row mt-5">
                    <div class="col-12 col-md-6">
                        <h4>How We Calculate Member Savings</h4>
                        <p class="mb-1 mt-3">
                            We estimate member savings based on information we have about our members and the deal we have negotiated for those members. For example, for our 2019 pool of graduate students, we know the following about our members.
                        </p>
                        <ul class="mt-2">
                            <li>Average of Loan Amount: $62K</li>
                            <li>Median of FICO Range: 740 to 760</li>
                            <li>Mode of Term of Loan: 10 years</li>
                            <li>Mode of Repayment Plan: Fully Deferred</li>
                        </ul>
                        <p>
                            Based on self-reported information by students and our knowledge of the deal negotiated, we can estimate average savings per typical member over the life of the loan to be between $12,680 and $13,476.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-left my-md-auto mt-3 mt-md-0">
                        <img src="{{ url('/img/typical-member-savings.svg') }}">

                    </div>
                </div>
            </div>

        </div>

        <hr>

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 my-auto">
                    <h4 class="text-center text-md-left">
                        We’ve helped thousands of students across dozens of universities secure over $250M in financing.
                    </h4>
                </div>

                <div class="col-12 col-md-5 mt-4 mt-md-0">
                    <h4>
                        <img src="{{ url('/img/university-logo-badges.png') }}" class="img-fluid">
                    </h4>
                </div>
            </div>
        </div>

        <hr>

        <div class="container py-md-5">
            <div class="row">
                <div class="col-12 col-md-6 my-auto">
                    <h4 class="text-center text-md-left">
                        Juno is a team-effort. We couldn't do it without you.
                    </h4>
                </div>
                <div class="col-12 col-md-6 text-center mt-4 mt-md-0">
                    <h1 style="font-size: 60px;">
                        <i class="fas fa-male brand-green"></i>
                        <i class="fas fa-male brand-green"></i>
                        <i class="fas fa-male brand-green"></i>
                        <i class="fas fa-male brand-green"></i>
                        <i class="fas fa-male brand-green"></i>
                        <i class="fas fa-male brand-green"></i>
                        <i class="fas fa-male brand-green"></i>
                        <i class="fas fa-male brand-green"></i>
                        <i class="fas fa-male brand-green"></i>
                        <i class="fas fa-male accent-pink"></i>
                    </h1>
                    <h1 class="mt-3 brand-color">9 out of 10</h1>
                    <h4>members hear about us from a friend</h4>
                </div>
            </div>
        </div>

        <hr>

        @include('common.testimonials')



    </main>
@endsection
