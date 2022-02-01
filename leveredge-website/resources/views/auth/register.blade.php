@extends('template.public')

@section('content')

    <div class="py-5"></div>

    <div class="container">

        @if (session('status'))
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="alert alert-success mt-3" role="alert">
                        {!! session('status') !!}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <h1 class="text-center">Juno</h1>

                <p class="btn btn-link btn-block my-3">
                    <a href="{{ url('login') }}">Already a Member? Login</a>
                </p>

                @include('auth._google-button', ['action' => 'Sign Up'])

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <input type="hidden" name="join_group" value="{{ Request::get('join_group') }}">

                    <div class="form-group">
                        <input autofocus id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', isset($piped_email) ? $piped_email : '' ) }}" placeholder="E-Mail Address" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-5"></div>


@endsection
