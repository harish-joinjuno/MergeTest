<label>What is your Credit Score?</label>
<select id="credit_score" class="form-control{{ $errors->has('credit_score') ? ' is-invalid' : '' }}" name="credit_score">
    <option value="">Select your Credit Score</option>
    @foreach( config('constant.credit_score_options') as $option )
        <option
            @if(old('credit_score', isset(Auth::user()->profile) ? Auth::user()->profile->credit_score : "" ) == $option) selected @endif
            value="{{ $option }}">
            {{ $option }}
        </option>
    @endforeach
</select>
@if ($errors->has('credit_score'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('credit_score') }}</strong>
    </span>
@endif
