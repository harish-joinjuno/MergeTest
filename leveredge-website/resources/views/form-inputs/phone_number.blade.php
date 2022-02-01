<label>What is your phone number?</label>
<input type="text" id="phone_number" name="phone_number" placeholder="2177664628"
       class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
       value="{{ old('phone_number', isset(Auth::user()->profile) ? Auth::user()->profile->phone_number : '') }}">
@if ($errors->has('phone_number'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('phone_number') }}</strong>
    </span>
@endif
