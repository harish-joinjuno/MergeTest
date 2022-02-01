@extends('template.public')

@section('content')

    <div class="py-5"></div>

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">

                <h1 class="text-center">Share your Quote</h1>

                <form class="mt-5" method="POST">
                    @csrf

                    @guest
                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    @endguest

                    <div class="mt-5">
                        <h4>Quote Details</h4>

                        <div class="form-group">
                            <label for="lender_id">Lender</label>
                            <select id="lender_id"
                                    class="form-control select2 @error('lender_id') is-invalid @enderror"
                                    name="lender_id" required>
                                <option value="">Select your Lender</option>
                                @foreach( $lenders as $lender )
                                    <option
                                        {{ old('lender_id') == $lender->id ? 'selected' : '' }}
                                        value="{{ $lender->id }}">
                                        {{ $lender->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lender_id')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rate_type_id">Rate Type</label>
                            <select id="rate_type_id"
                                    class="form-control @error('rate_type_id') is-invalid @enderror"
                                    name="rate_type_id" required>
                                <option value="">Select your Rate Type</option>
                                @foreach( $rate_types as $rate_type )
                                    <option
                                        {{ old('rate_type_id') == $rate_type->id ? 'selected' : '' }}
                                        value="{{ $rate_type->id }}">
                                        {{ $rate_type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rate_type_id')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="repayment_plan_id">Repayment Plan</label>
                            <select id="repayment_plan_id"
                                    class="form-control @error('repayment_plan_id') is-invalid @enderror"
                                    name="repayment_plan_id" required>
                                <option value="">Select your Repayment Plan</option>
                                @foreach( $repayment_plans as $repayment_plan )
                                    <option
                                        {{ old('repayment_plan_id') == $repayment_plan->id ? 'selected' : '' }}
                                        value="{{ $repayment_plan->id }}">
                                        {{ $repayment_plan->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('repayment_plan_id')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lender">Interest Rate</label>
                            <input id="interest_rate" type="text" class="form-control{{ $errors->has('interest_rate') ? ' is-invalid' : '' }}" name="interest_rate" value="{{ old('interest_rate') }}" placeholder="e.g. 1.67" required autofocus>
                            @if ($errors->has('interest_rate'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('interest_rate') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>

                    <div class="mt-5">
                        <h4>Your Profile</h4>

                        <div class="form-group">
                            <label for="lender_id">Credit Score</label>
                            <select id="lender_id"
                                    class="form-control select2 @error('lender_id') is-invalid @enderror"
                                    name="lender_id" required>
                                <option value="">Select your Lender</option>
                                @foreach( $lenders as $lender )
                                    <option
                                        {{ old('lender_id') == $lender->id ? 'selected' : '' }}
                                        value="{{ $lender->id }}">
                                        {{ $lender->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lender_id')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                    </div>


                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Submit Quote') }}
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
