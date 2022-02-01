@php
    $universities = \App\University::orderBy('name')->get();
@endphp
<label>University</label>
<select id="university_id" class="form-control{{ $errors->has('university_id') ? ' is-invalid' : '' }}" name="university_id">
    <option value="">Select your University</option>
    @foreach( $universities as $university )
        <option
            @if(old('university_id', isset(Auth::user()->profile) ? Auth::user()->profile->university_id : '' ) == $university->id) selected @endif
            value="{{ $university->id }}">
            {{ $university->name }}
        </option>
    @endforeach
</select>
@if ($errors->has('university_id'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('university_id') }}</strong>
    </span>
@endif
