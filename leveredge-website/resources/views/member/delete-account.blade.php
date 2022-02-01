@extends('template.public')

@section('content')
    <div class="container">
        <div class="new-dashboard">
            <div class="dashboard-row">
                <div class="head p-3 p-md-4">
                    <h2 class="h4 off-black mb-0 mx-md-2">
                        Delete My Account
                    </h2>
                    <hr class="mt-2 mt-md-3 mb-0 mb-md-2 mx-md-2">
                </div>
                <div class="content text-center p-3 p-md-5">
                    <h2 class="off-black mt-2 mt-md-0">
                        Looking to close your Juno account?
                    </h2>
                    <div class="desc py-2 mb-4">
                        <span>Just let us know why you'd like to leave, and then click the Close button below.</span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('member.remove-account') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="block font-bold mb-2" for="password">{{ __('Password') }}</label>
                                <input type="password"
                                       name="password"
                                       id="password"
                                       placeholder="Your password"
                                       class="form-control @error('password') is-invalid @enderror"/>
                                @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="block font-bold mb-2" for="reason">{{ __('Reason') }}</label>
                                <textarea
                                    name="reason"
                                    cols="80"
                                    rows="4"
                                    id="reason"
                                    class="form-control @error('reason') is-invalid @enderror"
                                    placeholder="We'll miss you!" >
                                    {{ old('reason') }}
                                </textarea>
                                @error('reason')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="button-content py-4 px-3">
                                <button type="submit" class="btn bg-secondary-green white rounded-pill py-2 px-5">
                                    <span class="my-1">Close</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
