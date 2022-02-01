@extends('template.public')

@section('content')

    <div class="py-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 text-center">
                <h1>Rats, something went wrong!</h1>
                <h3 class="mt-4">
                    We've been alerted and will look into this.
                </h3>
                <h3>
                    In the meantime, <a href="mailto:hello@joinjuno.com">you can send us an email</a>
                    if you’d like to know when it’s fixed.
                </h3>
                <a href="{{ url('/') }}" class="btn btn-secondary pill-radius mt-3">Take me home</a>
            </div>
        </div>
    </div>

    <div class="py-5"></div>

@endsection
