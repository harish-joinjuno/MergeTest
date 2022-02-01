@if($show)
<div class="card">
    <div class="card-header bg-white" id="heading{{ $question_id }}">
        <h4 class="mb-0 common-question-heading">
            <a class="question-heading" data-toggle="collapse" data-target="#collapse{{ $question_id }}" aria-expanded="true" aria-controls="collapse{{ $question_id }}">
                {{ $question }}
            </a>
        </h4>
    </div>

    <div id="collapse{{ $question_id }}" class="collapse show" aria-labelledby="heading{{ $question_id }}" data-parent="#accordion">
        <div class="card-body">
            {{ $answer }}
        </div>
    </div>
</div>

@else

<div class="card">
    <div class="card-header bg-white" id="heading{{ $question_id }}">
        <h4 class="mb-0 common-question-heading">
            <a class="collapsed question-heading" data-toggle="collapse" data-target="#collapse{{ $question_id }}" aria-expanded="false" aria-controls="collapse{{ $question_id }}">
                {{ $question }}
            </a>
        </h4>
    </div>
    <div id="collapse{{ $question_id }}" class="collapse" aria-labelledby="heading{{ $question_id }}" data-parent="#accordion">
        <div class="card-body">
            {{ $answer }}
        </div>
    </div>
</div>

@endif
