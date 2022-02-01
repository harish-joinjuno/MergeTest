<label>What is your Co-Signer's Credit Score?</label>
<select id="cosigner_credit_score" class="form-control{{ $errors->has('cosigner_credit_score') ? ' is-invalid' : '' }}" name="cosigner_credit_score">
    <option value="">Select Co-signer's Credit Score</option>
    @foreach( config('constant.credit_score_options') as $option )
        <option
            @if(old('cosigner_credit_score', isset(Auth::user()->profile) ? Auth::user()->profile->cosigner_credit_score : "") == $option) selected @endif
            value="{{ $option }}">
            {{ $option }}
        </option>
    @endforeach
</select>
@if ($errors->has('cosigner_credit_score'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('cosigner_credit_score') }}</strong>
    </span>
@endif
