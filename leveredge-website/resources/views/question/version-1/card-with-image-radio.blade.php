@push('header-scripts')
    <style>
        input[type="radio"]:checked ~ label .card-body {
            box-shadow: 0 0 0 0.2rem rgba(78, 133, 129, 0.5);
        }
    </style>
@endpush

<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <label>
            {{ $question['label'] }}
        </label>
        <div class="row justify-content-center align-items-center mb-3">
            @foreach($question->options as $index => $option)
                <div class="col-6 col-sm-3 text-center mb-3 d-flex flex-column align-self-stretch">
                    <div class="card h-100">
                        <input
                            id="{{ $question['field_name']  }}_option_{{ $index }}"
                            type="radio"
                            class="invisible card-radio no-track"
                            style="height:0;width:0;"
                            name="{{ $question['field_name'] }}"
                            value="{{ $option['value'] }}"
                        >

                        <label for="{{ $question['field_name']  }}_option_{{ $index }}" class="mb-0">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <img
                                    src="{{ $option['image'] ?? 'https://via.placeholder.com/150' }}"
                                    class="img-fluid mb-3"
                                    alt="Card Icon"
                                    style="width:150px;"
                                />
                                <div class="row flex-grow-1" style="min-height:6em;">
                                    <h6>{{ $option['label'] }}</h6>
                                </div>
                                <span
                                    class="btn btn-primary"
                                >
                                    Select
                                </span>
                            </div>
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
