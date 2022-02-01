@php /** @var \App\ScholarshipQuestion $scholarshipQuestion **/ @endphp
<div class="form-group col-12">
    <label for="graduation_year_select_{{ $scholarshipQuestion->id }}">
        {{ $scholarshipQuestion->label }}
    </label>
    <select
        class="form-control select-2"
        id="graduation_year_select_{{ $scholarshipQuestion->id }}"
        name="{{ $scholarshipQuestion->field_name }}"
    >
        <option value="">Select your graduation year</option>
        <option>2025</option>
        <option>2024</option>
        <option>2023</option>
        <option>2022</option>
        <option>2021</option>
        <option>2020</option>
        <option>2019</option>
        <option>I don't know</option>
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
