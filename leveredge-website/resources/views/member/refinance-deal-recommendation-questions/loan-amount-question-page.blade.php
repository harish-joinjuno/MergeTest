@extends('template.public')

@section('content')
    <div class="py-4 py-lg-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 text-center">
                <p class="text-center">(1 of 3)</p>
                <h1 class="off-black">How much are you looking to refinance?</h1>
                <h4 class="mt-3 mb-4">
                    Certain lenders have limits on the maximum you can refinance.
                    We limit the options we show you to lenders you are more likely to be eligible to refinance with.
                </h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-8 col-lg-3 text-center">
                <form class="mt-5" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="zip_code">Loan Amount</label>
                        <input
                            id="loan_amount"
                            type="number"
                            class="form-control{{ $errors->has('loan_amount') ? ' is-invalid' : '' }}"
                            name="loan_amount"
                            min="0"
                            value="{{ old('loan_amount') }}"
                            inputmode="numeric"
                            required
                            autofocus>
                        @if ($errors->has('loan_amount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('loan_amount') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group mb-0 mt-5">
                        <a href="{{ url('/member/negotiation-group/'.$negotiationGroupUser->negotiationGroup->id.'/refinance-deal-recommendation-questions') }}" class="btn btn-outline-primary">Back</a>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="py-5"></div>
    <div class="py-5"></div>
@endsection
