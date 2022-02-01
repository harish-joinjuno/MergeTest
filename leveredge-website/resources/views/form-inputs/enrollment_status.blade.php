<label>What is your enrollment status?</label>
<select id="enrollment_status" class="form-control{{ $errors->has('enrollment_status') ? ' is-invalid' : '' }}" name="enrollment_status">
    <option value="">Select your Enrollment Status</option>
    @foreach( config('constant.enrollment_status_options') as $option )
        <option
            @if(old('enrollment_status', isset(Auth::user()->profile) ? Auth::user()->profile->enrollment_status : "" ) == $option) selected @endif
            value="{{ $option }}">
            {{ $option }}
        </option>
    @endforeach
</select>
@if ($errors->has('enrollment_status'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('enrollment_status') }}</strong>
    </span>
@endif
