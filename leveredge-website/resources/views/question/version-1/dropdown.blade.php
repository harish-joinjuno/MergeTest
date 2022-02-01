@php
    $prefillValue = $question->getPrefillValue();
@endphp
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div
            id="{{ $question->field_name }}_form_group"
            class="form-group dynamic {{ !empty($question->getVisibilityPolicyDefinition()) ? 'd-none' : '' }}"
        >
            @include('question.version-1.partials._before_field')

            <input
                id="{{ $question->field_name }}_visibilityPolicy"
                type="hidden"
                value="{{ json_encode($question->getVisibilityPolicyDefinition()) }}"
            >

            <select
                id="{{ $question->id }}"
                class="form-control{{ $errors->has($question->field_name) ? ' is-invalid' : '' }}"
                name="{{ $question->field_name }}"

                @if($question->isFirstOnPage()) autofocus @endif
            >
                @if($question->placeholder)
                    <option value="">{{ $question->placeholder }}</option>
                @endif
                @foreach($question->options as $option)
                    <option
                        value="{{ $option['value'] }}"
                        @if($prefillValue == $option['value']) selected @endif
                    >
                        {{ $option['label'] }}
                    </option>
                @endforeach
            </select>

            @include('question.version-1.partials._after_field')
        </div>
    </div>
</div>

