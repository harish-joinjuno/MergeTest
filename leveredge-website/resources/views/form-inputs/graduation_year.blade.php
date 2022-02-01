<label>Which year will you / did you graduate?</label>
<input type="number" min="1900" max="2050" id="graduation_year" name="graduation_year" placeholder="Graduation Year"
       class="form-control{{ $errors->has('graduation_year') ? ' is-invalid' : '' }}"
        value="{{ old('graduation_year', isset(Auth::user()->profile) ? Auth::user()->profile->graduation_year : '' ) }}">
@if ($errors->has('graduation_year'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('graduation_year') }}</strong>
    </span>
@endif
