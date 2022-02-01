<div class="help-text">
    {!! $question->helper_text !!}
</div>

@error($question->field_name)
<p class="text-danger mt-1" role="alert">
    {{ $message }}
</p>
@enderror
