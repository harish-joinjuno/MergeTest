@php /** @var \App\ScholarshipQuestion $scholarshipQuestion **/ @endphp
<div class="form-group col-12 col-sm-6">
    <label for="short_text_{{ $scholarshipQuestion->id }}">
        {{ $scholarshipQuestion->label }}
    </label>
    <input
        type="text"
        class="form-control"
        id="short_text_{{ $scholarshipQuestion->id }}"
        name="{{ $scholarshipQuestion->field_name }}"
    >
    @if($scholarshipQuestion->helper_text)
        <p class="small px-sm-3 mt-1 mb-0 text-muted">
            {{ $scholarshipQuestion->helper_text }}
        </p>
    @endif
    @error($scholarshipQuestion->field_name)
        <div class="text-danger" role="alert">
            <small>
                {{ $errors->first($scholarshipQuestion->field_name) }}
            </small>
        </div>
    @enderror
</div>
