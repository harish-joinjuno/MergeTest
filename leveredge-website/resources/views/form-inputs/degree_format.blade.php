<label>Is the program online or on-campus?</label>
<select id="degree_format" class="form-control{{ $errors->has('degree_format') ? ' is-invalid' : '' }}" name="degree_format">
    <option value="">Select your Degree Format</option>
    @foreach( config('constant.degree_format_options') as $option )
        <option
            @if(old('degree_format', isset( Auth::user()->profile ) ? Auth::user()->profile->degree_format : '' ) == $option) selected @endif
            value="{{ $option }}">
            {{ $option }}
        </option>
    @endforeach
</select>
@if ($errors->has('degree_format'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('degree_format') }}</strong>
    </span>
@endif
