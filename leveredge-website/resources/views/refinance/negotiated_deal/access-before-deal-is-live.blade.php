@extends('template.public')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if( session('status') )
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endif


                <div class="alert alert-info">
                    Earnest will start offering the negotiated deal on July 10th to Juno Members.<br>
                    Sign up below and we will send you an access code on July 10th.
                </div>

                    @include('refinance.form.form-1')

            </div>
        </div>
    </div>

@endsection
