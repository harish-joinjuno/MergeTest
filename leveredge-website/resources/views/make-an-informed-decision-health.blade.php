@extends('template.public')

@php

$compare_messages = [

"Hey everyone, just wanted to let you know about Juno, they are a student focused negotiation group. I took my health insurance through them and saved thousands!",

"If you are looking for student loans or health insurance, check out Juno, they are a student focused negotiation group that gets the best deals in the market.",

];

$switching_messages = [



"If you are looking for an alternative to the university plan, I took my health insurance through Juno, their deal guarantees waiver acceptance or money back.",

"I got my health insurance at Juno and got a quick waiver acceptance from the university.",

];

$federal_messages = [


"If anyone is looking for health insurance alternatives, I took the Juno deal and saved more than 1k",

"I just took the Juno negotiated health insurance deal. It saved me thousands compared to the university sponsored plan",

];

$counter = 0;

@endphp

@section('content')


    <div class="jumbotron mt-0 mb-0 pt-0 pb-5 bg-white">
        <div class="container mt-0 mb-0 pt-0 pb-0">
            <div class="row mt-5">
                <div class="col-12 text-center">

{{--                    <div class="alert alert-danger">--}}
{{--                        <p>--}}
{{--                            This offer has expired--}}
{{--                        </p>--}}
{{--                    </div>--}}

                    <h1 style="line-height: 1.5" class="d-none d-md-block">Get $10 for Talking About Juno</h1>
                    <h1 style="line-height: 1.5" class="d-md-none">Get $10 for <br> Talking About Juno.</h1>
                    <h2 style="text-transform: none" class="d-none d-md-block">and help your classmates save thousands</h2>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-12">

                    <h2>How This Works</h2>
                    <div class="separator"></div>

                    <ol class="mt--3">
                        <li>Make a Post in your Program's Group Chat</li>
                        <li>Fill out this <a href="https://joinjuno.com/member/screenshot-reward">form</a>.</li>
                        <li>We will send a $10 Amazon E-Gift Card to the first 10 students from each eligible program.</li>
                    </ol>

                    <p class="mt-3">
                        <a data-toggle="collapse" href="#valid-post" role="button" aria-expanded="false" aria-controls="valid-post">
                            Where and what constitutes a valid post?
                        </a>
                    </p>

                    <div class="collapse" id="valid-post">
                        <p class="mt-3">
                            Slack, Group Me, Facebook Group, WhatsApp, even Email is fine :).
                        </p>

                        <p class="mt-3">
                            You don’t have to post positive information about Juno or the negotiated deal to be eligible for the $10 Amazon Gift Card. Our only ask is that you make an honest post with the intent of helping your community make an informed decision about health insurance.
                        </p>

                    </div>

                    <hr>

                    <p class="mt-3">
                        Here are a few examples of messages you can share with your classmates to get the discussion about health insurance going.
                    </p>
                </div>

                <div class="col-12 mt-5">
                    <h3>About Juno</h3>
                </div>


                @foreach($compare_messages as $message)

                    @php
                        $counter++;
                    @endphp

                    <div class="col-12 col-md-6 col-lg-4 mt-3">
                        <div class="card">
                            <div class="card-body">
                                    <span id="example-{{ $counter }}">
                                        {!! $message !!}
                                    </span>
                            </div>
                            <div class="card-footer">
                                <a href="#copy" class="btn btn-primary copy-button" data-clipboard-target="#example-{{ $counter }}">Copy to Clipboard</a>
                            </div>
                        </div>
                    </div>

                @endforeach


                <div class="col-12 mt-5">
                    <h3>Waiver acceptance</h3>
                </div>
                @foreach($switching_messages as $message)

                    @php
                        $counter++;
                    @endphp

                    <div class="col-12 col-md-6 col-lg-4 mt-3">
                        <div class="card">
                            <div class="card-body">
                                    <span id="example-{{ $counter }}">
                                        {!! $message !!}
                                    </span>
                            </div>
                            <div class="card-footer">
                                <a href="#copy" class="btn btn-primary copy-button" data-clipboard-target="#example-{{ $counter }}">Copy to Clipboard</a>
                            </div>
                        </div>
                    </div>

                @endforeach



                <div class="col-12 mt-5">
                    <h3>Insurance deal</h3>
                </div>

                @foreach($federal_messages as $message)

                    @php
                        $counter++;
                    @endphp

                    <div class="col-12 col-md-6 col-lg-4 mt-3">
                        <div class="card">
                            <div class="card-body">
                                    <span id="example-{{ $counter }}">
                                        {!! $message !!}
                                    </span>
                            </div>
                            <div class="card-footer">
                                <a href="#copy" class="btn btn-primary copy-button" data-clipboard-target="#example-{{ $counter }}">Copy to Clipboard</a>
                            </div>
                        </div>
                    </div>

                @endforeach




            </div>
        </div>
    </div>

@endsection


@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

    <script>
        new ClipboardJS('.copy-button');
    </script>
@endpush
