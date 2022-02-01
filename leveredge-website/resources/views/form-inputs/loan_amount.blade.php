<input type="number" min="0" id="loan_amount" name="loan_amount" placeholder="Loan Amount"
       class="form-control{{ $errors->has('loan_amount') ? ' is-invalid' : '' }}"
        value="{{ old('loan_amount', isset(Auth::user()->profile) ? Auth::user()->profile->loan_amount : '' ) }}">
