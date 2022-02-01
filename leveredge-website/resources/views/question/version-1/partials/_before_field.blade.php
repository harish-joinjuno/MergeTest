<label id="{{ $question->id }}">
    {{ $question->label }} @if($question->isRequired()) <span style="color: red">*</span> @endif
    @if($question->tooltip)
        <i data-toggle="tooltip" data-placement="top" title="{{ $question->tooltip }}" class="fas fa-question-circle ml-2"></i>
    @endif
</label>
