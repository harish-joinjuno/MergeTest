<label>How much do you expect to earn over the next 12 months</label>
<input type="number" min="0" id="annual_income" name="annual_income" placeholder="Annual Income"
       class="form-control{{ $errors->has('annual_income') ? ' is-invalid' : '' }}"
       value="{{ old('annual_income', isset(Auth::user()->profile) ? Auth::user()->profile->annual_income : '') }}">
<p class="small-text">
    An estimate is okay. Many students will have no income.
</p>
@if ($errors->has('annual_income'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('annual_income') }}</strong>
    </span>
@endif
