@extends('template.public')

@section('content')


    @if(session()->has('alert'))
    <div class="container pb-0">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Alert</div>
                    <div class="card-body">
                        <h5 class="card-title"> {{ Session::get('alert') }} </h5>
                        {{--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


    <div class="container pt-0">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Password Protected Page') }}</div>

                    <div class="card-body">
                        <form method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Get Access') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
