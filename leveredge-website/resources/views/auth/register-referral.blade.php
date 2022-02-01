@extends('template.public')

@prepend('footer-scripts')
    <script type="text/javascript">
        mixpanel.track('referral_homepage_pressed', {
            user_type: '{{ empty(user()) ? 'visitor' : 'user' }}',
        });
    </script>
@endprepend

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
                <h1 class="text-center">Juno Referral Program</h1>

                <p class="btn btn-link btn-block my-3">
                    <a href="{{ url('login') }}">Already a Member? Login</a>
                </p>

                <form method="POST" action="{{ url('register-referral') }}">
                    @csrf

                    <div class="form-group">
                        <input autofocus id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name', isset($piped_first_name) ? $piped_first_name : '' ) }}" placeholder="First Name" required>
                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name', isset($piped_last_name) ? $piped_last_name : '' ) }}" placeholder="Last Name" required>
                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', isset($piped_email) ? $piped_email : '' ) }}" placeholder="E-Mail Address" required>
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
                            {{ __('Register for the Referral Program') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-5"></div>


@endsection
