@extends('template.public')

@section('content')
    <div class="py-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 col-md-4">
                <h1 class="text-center">Juno</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form class="mt-5" method="POST" action="">
                    @csrf

                    <div class="form-group">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="Name" required>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Access the Deal') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="py-5"></div>
@endsection
