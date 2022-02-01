@extends('template.public')

@php

$compare_messages = [

"I just got the Juno rates. Way better than anything else I could find!",

"Just secured my loan for X.X% using the Juno deal beating [Other Lender] by x%.",

"Has anyone tried shopping around to check if the Juno deal is indeed the best option for them? I got a X.X% loan. Has anyone gotten a better deal elsewhere?",

//"I got a X.X% rate for a 7 year fixed loan with deferred payments from the Juno deal. The best loan option I had previously was X.X% for a similar loan. Both options have an autopay discount. Anyone else having a similar experience?",

//"Has anyone tried shopping around to check if the Juno deal is indeed the best option for them? I got a X.X% loan for a 7 year fixed (with $50 payments in school, includes the auto pay discount). Has anyone gotten a better deal elsewhere?",

];

$switching_messages = [


// "Has anyone switched from the federal loan options to the Juno deal? What was the process like?",

"Has anyone cancelled their loan with [insert lender] and taken the Juno deal instead?",

"For anyone wondering if it is possible, I was able to switch from the federal loans to the Juno deal. Let me know if you have any questions about switching",

"I managed to cancel my loan with X and switch to the Juno deal. It was fairly easy. Let me know if you have any questions about switching",

];

$federal_messages = [


// "Hi everyone, I am writing to make you aware about a new loan option for domestic students that has better terms than what most lenders are offering. It was negotiated by a group of more than 2,000 students at programs like Harvard, Wharton, Berkeley etc. Details below <br> <br> No prepayment penalties, <br> no origination fees, <br> no application fees <br> <br> Fixed Interest Rates: <br> 5 years starting at 4.10%, <br> 7 years starting at 4.09%, <br> 10 years starting at 4.42%, <br> 15 years starting at 4.89%. <br> <br> If you are interested you can check it out here: https://joinjuno.com/negotiated-in-school-deal",

"I am trying to think about how to finance my MBA. What are the tradeoffs between the federal loan options and the Juno negotiated deal?",

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

                    <h1 style="line-height: 1.5" class="d-none d-md-block">Get $25 for Talking About Student Loans</h1>
                    <h1 style="line-height: 1.5" class="d-md-none">Get $25 for <br> Talking About Student Loans.</h1>
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
                        <li>Email a screenshot of the post to <a href="mailto:support@joinjuno.com">support@joinjuno.com</a>.</li>
                        <li>We will send a $25 Amazon E-Gift Card to the first 10 students from each eligible program.</li>
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
                            The post should be after July 13th 4:00 PM ET.
                        </p>

                        <p class="mt-3">
                            You don’t have to post positive information about Juno or the negotiated deal to be eligible for the $25 Amazon Gift Card. Our only ask is that you make an honest post with the intent of helping your community make an informed decision about student loans.
                        </p>

                        <p class="mt-3">
                            For example, if you are comparing interest rates, ensure they are for similar loan terms etc.
                        </p>

                        <p>
                            Eligible programs include all programs that are eligible for a graduate student loan with Laurel Road.
                        </p>

                    </div>

                    <hr>

                    <p class="mt-3">
                        Here are a few examples of messages you can share with your classmates to get the discussion about student loans going.
                    </p>
                </div>

                <div class="col-12 mt-5">
                    <h3>Comparing Private Loan Options</h3>
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
                    <h3>Switching to the Juno Loan</h3>
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
                    <h3>Federal vs. Negotiated Deal</h3>
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
