@extends('template.public')

@section('social-image',url('/img/scholarship-image.jpg'))

@section('content')

    <div class="jumbotron bg-white mt-0 mb-0 pt-0 pb-0" id="modern-hero">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Alumni, Current, and Incoming students are all eligible.</h1>
                    <h2><strong><span class="green-color">Win $5K</span> to help pay for grad school</strong></h2>

                    {{--<p class="tips">--}}
                        {{--<img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">--}}
                        {{--&nbsp; There are no fees for students.--}}
                    {{--</p>--}}

                    {{--<p class="tips">--}}
                        {{--<img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">--}}
                        {{--&nbsp; It takes less than 1 minute to join.--}}
                    {{--</p>--}}
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">

                            <p class="mb-3">
                                The 2019 Juno Scholarship Program has concluded.
                                One winner has been selected from Fuqua (the program with the highest participation).
                                More details about the winner will be released shortly.
                            </p>
{{--                            @include('scholarship-2019.scholarship-sign-up-form')--}}
                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="row mt-5">--}}
{{--                <div class="col-12">--}}
{{--                    <p>--}}
{{--                        By clicking Submit, I indicate my agreement to the <a href="#official-rules">Official Rules</a> and the <a href="{{ url('/privacy') }}">Juno Privacy Policy</a>.--}}
{{--                    </p>--}}

{{--                    <p class="mt-3">--}}
{{--                    No purchase or payment of any kind is necessary to enter or win. Void where prohibited.  Only US legal residents 18+ who are currently enrolled in a graduate degree program or will be enrolled in an graduate degree program in Fall 2019 or have completed a graduate degree program may enter. Enter by September 30th, 2019.  One prize: a check for $5,000; ARV $5,000. Odds of winning depend on the number of eligible entries from each program, the number of eligible entries from the entrants program and the total number of eligible entries. Prize may not be transferred or substituted. Sponsored by LeverEdge Association (Juno), 6 Soldiers Field Park APT 505, Boston, MA 02163.--}}
{{--                    </p>--}}


{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>


    @include('scholarship-2019.scholarship-current-progress')

    @include('scholarship-2019.scholarship-terms-and-conditions')

@endsection
