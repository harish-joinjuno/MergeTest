@php /** @var \App\ScholarshipQuestion $scholarshipQuestion **/ @endphp
<div class="form-group col-12">
    <label for="degree_select_{{ $scholarshipQuestion->id }}">{{ $scholarshipQuestion->label }}</label>
    <select
        class="form-control select-2"
        id="degree_select_{{ $scholarshipQuestion->id }}"
        name="{{ $scholarshipQuestion->field_name }}"
    >
        <option value="">Select your degree</option>
        @foreach(\App\Degree::whereType('undergraduate')->orderBy('name')->get() as $degree)
            <option>{{ $degree->name }}</option>
        @endforeach
    </select>
    @if($scholarshipQuestion->helper_text)
        <p class="small px-sm-3 mt-1 mb-0 text-muted">
            {{ $scholarshipQuestion->helper_text }}
        </p>
    @endif
    @error($scholarshipQuestion->field_name)
    <div class="text-danger" role="alert">
        <small>{{ $errors->first($scholarshipQuestion->field_name) }}</small>
    </div>
    @enderror
</div>
