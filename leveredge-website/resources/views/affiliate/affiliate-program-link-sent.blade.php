@extends('template.public')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>
                    Hi {{ $affiliate->name }},
                </p>
                <p class="mt-3">
                    Check your email. We have sent you a link to your Referral Program Dashboard.
                </p>
            </div>
        </div>
    </div>

@endsection
