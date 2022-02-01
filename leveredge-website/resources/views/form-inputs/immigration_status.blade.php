<label>Are you a domestic or international student?</label>
<select id="immigration_status" class="form-control{{ $errors->has('immigration_status') ? ' is-invalid' : '' }}" name="immigration_status">
    <option value="">I am a</option>
    @foreach( config('constant.immigration_status_options') as $option )
        <option
            @if(old('immigration_status', isset(Auth::user()->profile) ? Auth::user()->profile->immigration_status : "") == $option) selected @endif
            value="{{ $option }}">
            {{ $option }}
        </option>
    @endforeach
</select>
@if ($errors->has('immigration_status'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('immigration_status') }}</strong>
    </span>
@endif
