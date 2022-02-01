<label>Do you have a Co-Signer?</label>
<select id="cosigner_status" class="form-control{{ $errors->has('cosigner_status') ? ' is-invalid' : '' }}" name="cosigner_status">
    <option value="">Do you have a U.S. co-signer?</option>
    @foreach( config('constant.cosigner_status_options') as $option )
        <option
            @if(old('cosigner_status' , isset(Auth::user()->profile) ? Auth::user()->profile->cosigner_status : '' ) == $option[0]) selected @endif
            value="{{ $option[0] }}">
            {{ $option[0] }}
        </option>
    @endforeach
</select>
@if ($errors->has('cosigner_status'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('cosigner_status') }}</strong>
    </span>
@endif
