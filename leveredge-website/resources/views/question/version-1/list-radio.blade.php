<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="form-group">
            @include('question.version-1.partials._before_field')

            @foreach($question->options as $option)
            <ul class="list-group">
                <li class="list-group-item">
                    <form method="post">
                        @csrf
                        <input type="hidden" name="{{ $question->field_name }}" value="{{ $option['value'] }}">
                        <p class="academic-year-title d-inline">{{ $option['label'] }}</p>
                        <button type="submit" class="btn btn-sm btn-primary float-right" id="{{ \Illuminate\Support\Str::slug($option['label'], '_') }}">Select</button>
                    </form>
                </li>
            </ul>
            @endforeach

            @include('question.version-1.partials._after_field')
        </div>
    </div>
</div>
