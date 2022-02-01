@extends('template.public')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-12">
                <h2>Invitation Templates</h2>
                <div class="separator"></div>
            </div>
        </div>

        <div class="row mt--3">
            <div class="col-md-6 col-12">

                <h4>Great for Email</h4>

                <div class="card mt-3">
                    <div class="card-body" id="text-one-for-sharing">

                        If you are graduating with student debt, make sure to check out Juno. They’re fellow students trying to lower interest rates on our student loans using group buying power.
                        <br><br>
                        Signing up is free (until April 30th) and there’s no obligation to take the loan they negotiate.
                        <br><br>
                        Once you signup, they ask various lenders to compete by offering lower rates.
                        Finally, they share the lowest offer they received (by May 30th).
                        <br><br>
                        At that point, you can decide if you like the offer or not and if you want to take it.
                        <br><br>
                        You can sign up here: https://joinjuno.com/join/refi/for/{{ $affiliate }}

                    </div>

                    <div class="card-footer">
                        <a href="" class="btn btn-outline-primary copy-button" data-clipboard-target="#text-one-for-sharing">Copy to Clipboard</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12 mt-4 mt-md-0">

                <h4>Great for Slack, Facebook, Group Me or WhatsApp</h4>
                <div class="card mt-3">
                    <div class="card-body" id="text-two-for-sharing">Our friends over at HBS started a collective bargaining association that negotiates lower rates when refinancing student loans. There are only {{ \Carbon\Carbon::create(2019,4,30)->diffInDays() }} days remaining before they close the negotiation group for students graduating in Spring 2019. Seems that it is open to everyone (domestic and international students) and the more people that apply through this the higher chances of success. You can find more details over at https://joinjuno.com/join/refi/for/{{ $affiliate }}
                    </div>

                    <div class="card-footer">
                        <a href="" class="btn btn-outline-primary copy-button" data-clipboard-target="#text-two-for-sharing">Copy to Clipboard</a>
                    </div>
                </div>
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

