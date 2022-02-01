@php
    $degrees = \App\Degree::all();
@endphp
<label>Degree</label>
<select id="degree_id" class="form-control{{ $errors->has('degree_id') ? ' is-invalid' : '' }}" name="degree_id">
    <option value="">Select your Degree</option>
    @foreach( $degrees as $degree )
        <option
            @if(old('degree_id', isset( Auth::user()->profile ) ? Auth::user()->profile->degree_id : '' ) == $degree->id) selected @endif
            value="{{ $degree->id }}">
            {{ $degree->name }}
        </option>
    @endforeach
</select>
@if ($errors->has('degree_id'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('degree_id') }}</strong>
    </span>
@endif
