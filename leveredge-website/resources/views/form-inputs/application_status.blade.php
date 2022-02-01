<label>Where are you on your academic journey?</label>
<select id="application_status" class="form-control{{ $errors->has('application_status') ? ' is-invalid' : '' }}" name="application_status" required>
    <option value="">Select your Application Status</option>
    @foreach( config('constant.application_status_options') as $option )
        <option
            @if(old('application_status', isset(Auth::user()->profile) ? Auth::user()->profile->application_status : "" ) == $option[0]) selected @endif
            value="{{ $option[0] }}">
            {{ $option[0] }}
        </option>
    @endforeach
</select>
@if ($errors->has('application_status'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('application_status') }}</strong>
    </span>
@endif
