@php /** @var \App\ScholarshipQuestion $scholarshipQuestion **/ @endphp
<div id="educationLevel" class="form-group col-12">
    <label for="level_of_education_select_{{ $scholarshipQuestion->id }}">{{ $scholarshipQuestion->label }}</label>
    <select
        class="form-control"
        id="level_of_education_select_{{ $scholarshipQuestion->id }}"
        name="{{ $scholarshipQuestion->field_name }}"
    >
        <option>Undergraduate Student</option>
        <option>Graduate Student</option>
        <option>Parent</option>
    </select>
    @if($scholarshipQuestion->helper_text)
        <p class="small px-sm-3 mt-1 mb-0 text-muted">
            {{ $scholarshipQuestion->helper_text }}
        </p>
    @endif
    @error($scholarshipQuestion->field_name)
    <div
        class="text-danger"
        role="alert"
    >
        <small>{{ $errors->first($scholarshipQuestion->field_name) }}</small>
    </div>
    @enderror
</div>
