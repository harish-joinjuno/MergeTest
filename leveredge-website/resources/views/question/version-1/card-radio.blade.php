<div class="row">
    @foreach($question->options as $option)
    <div class="col-12 col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h4>{{ $option['label'] }}</h4>

                @if(!empty($option['description']))
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <p class="mt-3">{{ $option['description'] }}</p>
                    </div>
                </div>
                @endif

                <form method="post">
                    @csrf
                    <input type="hidden" name="{{ $question->field_name }}" value="{{ $option['value'] }}">
                    <button type="submit" class="btn btn-primary" id="{{ $option['value'] }}">Select</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
