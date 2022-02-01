@extends('template.public')

@push('header-scripts')
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-social.css') }}">
@endpush

@section('content')

    <div class="py-5"></div>

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">

                <h1 class="text-center">Juno</h1>

                <a class="btn btn-link btn-block my-3" href="{{ route('register') }}">
                    {{ __('Not a member yet? Sign up for free!') }}
                </a>

                @include('auth._google-button', ['action' => 'Login'])

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>
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

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Login') }}
                        </button>

                        <a class="btn btn-link btn-block" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="py-5"></div>

@endsection
