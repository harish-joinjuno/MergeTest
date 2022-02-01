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

            <input
                id="{{ $question->id }}"
                type="text"
                class="form-control{{ $errors->has($question->field_name) ? ' is-invalid' : '' }}"
                name="{{ $question->field_name }}"
                value="{{ $question->getPrefillValue() }}"
                placeholder="{{ $question->placeholder }}"
{{--                @if($question->isRequired()) required @endif--}}
                @if($question->isFirstOnPage()) autofocus @endif
            >

            @include('question.version-1.partials._after_field')
        </div>
    </div>
</div>
