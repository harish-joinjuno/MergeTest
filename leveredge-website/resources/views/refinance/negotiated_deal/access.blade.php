@extends('template.public')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">



                <h1 class="text-center mb-3">Access The Refinance Deal</h1>

                @if( session('status') )
                    <div class="alert alert-danger">
                         {!! session('status') !!}
                    </div>
                @endif

                <div class="alert alert-info mb-5">
                    <p>
                        Once you submit this form, you will be redirected straight into the Earnest Application Portal where you will get the negotiated rates.
                    </p>

                    <p class="mt-3">
                        You will not see anything within the Earnest Application to indicate you are receiving the Juno deal.
                    </p>
                </div>


                <form method="POST" action="{{ url('/negotiated-refinance-deal/access') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>


                    <input id="access_code" type="hidden" class="form-control{{ $errors->has('access_code') ? ' is-invalid' : '' }}" name="access_code" value="{{ (is_null($accessCode)) ? old('access_code') : $accessCode }}">

                    {{--<div class="form-group row">--}}
                        {{--<label for="access_code" class="col-sm-4 col-form-label text-md-right">{{ __('Access Code') }}</label>--}}

                        {{--<div class="col-md-6">--}}
                            {{--<input id="access_code" type="text" class="form-control{{ $errors->has('access_code') ? ' is-invalid' : '' }}" name="access_code" value="{{ (is_null($accessCode)) ? old('access_code') : $accessCode }}">--}}

                            {{--@if ($errors->has('access_code'))--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('access_code') }}</strong>--}}
                        {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">

                            <div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Continue to Earnest') }}
                                </button>
                            </div>

                            <div class="mt-2 text-underline">
                                <a href="{{ url('/negotiated-refinance-deal/no-access-code') }}">
                                    {{ __("I don't have an Access Code") }}
                                </a>
                            </div>

                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection
