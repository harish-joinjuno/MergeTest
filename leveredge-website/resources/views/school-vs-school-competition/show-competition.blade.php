@extends('template.public')

@section('content')
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="mb-3">
                            {{ $competition->colloquial_name_one }} vs. {{ $competition->colloquial_name_two }}
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-6">
                        <h2 class="mb-5">
                            Don’t let them win the
                            ${{ number_format($competition->first_prize_amount * $competition->number_of_prizes)  }}
                        </h2>
                        <p class="mb-3 text-muted">
                            🚀 We just launched at {{ $competition->colloquial_name_one }} and
                            {{ $competition->colloquial_name_two }} and are giving away 5 scholarships to students on the
                            first campus to hit 1000 sign ups
                        </p>
                        <p class="mb-3 text-muted">
                            🤑 Sign up to the competition and help your campus win!
                        </p>
                        <form
                            class="mt-5"
                            method="post"
                            action="{{ url('/competition/' . $competition->id) }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input
                                        type="text"
                                        name="email"
                                        class="form-control pill-radius"
                                        placeholder="Email Address"
                                        aria-label="Email Address"
                                        aria-describedby="basic-addon2"
                                        autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary pill-radius" type="submit">
                                            Enter Competition
                                        </button>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Use a .edu email address for instant entry into the competition
                                </small>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-4 offset-lg-1 col-lg-4">
                        <img src="{{ asset('/assets/images/school-vs-school/img.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <h2 class="mb-3">Current Status</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 text-center">
                        <competition-status-chart
                            :competition='@json($competition)'
                        >
                        </competition-status-chart>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-grey">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 text-center">
                        <h2>Why Compete?</h2>
                        <p>
                            There is nothing more enjoyable than beating out your rival campus and letting the whole
                            world know you won the scholarship money.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 text-center">
                        <h2>How many scholarships are offered?</h2>
                        <p>
                            We’re giving away ${{ number_format($competition->first_prize_amount) }}
                            scholarships to {{ $competition->number_of_prizes }} students from the winning campus.
                            No strings attached!
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-grey">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 text-center">
                        <h2>When will the winners be declared?</h2>
                        <p>
                            As soon as either campus hits {{ $competition->target_number_of_students }} signups,
                            we will send an email to all participants announcing the campus that won along with the
                            scholarship recipients.
                        </p>
                    </div>
                </div>
            </div>
        </section>
@endsection
