@extends('template.public')

@section('content')

    <div class="jumbotron pt-0 pb-0 mt-0 mb-0 bg-white">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <h1 class="text-uppercase">
                        Join the Waitlist
                    </h1>
                </div>

                <div class="col-12 col-md-9 mt-5">
                    <h4>
                        Thousands of graduate students have been given priority access for helping with the negotiations. You can get an access code from them or join the wait list and we will send you an access code in 2 to 4 days.
                    </h4>
                </div>

                <div class="col-12 col-md-3">
                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="card-body text-center">
                            <p>
                                Current Wait Time
                            </p>
                            <h2>2-4 Days</h2>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-md-8 offset-md-2 mt-5">
                    @include('refinance.no_access_code.waiting_list_option')
                </div>

            </div>
        </div>
    </div>


@endsection
