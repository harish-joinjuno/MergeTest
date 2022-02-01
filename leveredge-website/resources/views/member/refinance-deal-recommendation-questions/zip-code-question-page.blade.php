@extends('template.public')

@section('content')
    <div class="py-4 py-lg-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 text-center">
                <p class="text-center">(2 of 3)</p>
                <h1 class="off-black">Where do you live?</h1>
                <h4 class="mt-3 mb-4">
                    Certain lenders offering favorable rates limit their service to specific cities.
                    If you live in one of the zip codes they service, we’ll show you that option.
                </h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-8 col-lg-3 text-center">
                <form class="mt-5" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="zip_code">Zip Code</label>
                        <input
                            id="zip_code"
                            type="text"
                            class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}"
                            name="zip_code"
                            value="{{ old('zip_code') }}"
                            placeholder="-----"
                            required
                            autofocus>
                        @if ($errors->has('zip_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('zip_code') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group mb-0 mt-5">
                        <a href="{{ url('/member/negotiation-group/'.$negotiationGroupUser->negotiationGroup->id.'/refinance-deal-recommendation-questions/loan-amount') }}" class="btn btn-outline-primary">Back</a>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="py-5"></div>
    <div class="py-5"></div>
@endsection
