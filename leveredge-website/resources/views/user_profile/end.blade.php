@extends('template.public')

@section('content')

    <div class="py-5"></div>

    <div class="container signup-container">

        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="mb-3">{{ $negotiationGroup->endScreen->heading }}</h2>
                <h4>{{ $negotiationGroup->endScreen->description }}</h4>
            </div>
        </div>

        <div class="row text-center justify-content-center">
            @foreach($negotiationGroup->endScreen->infoCardElements as $infoCard)
                <div class="col-12 col-md-4">
                    <img class="img-fluid" src="{{ asset($infoCard->icon) }}" style="max-height: 180px;">
                    <h4 class="fw-500 mb-4">{{ $infoCard->title }}</h4>
                    <p>
                        {!! $infoCard->description  !!}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col text-center">
                <div class="sign-up-next form-group mb-0 mt-5">
                    <div class="mb-2">
                        <a href="{{ url($negotiationGroup->endScreen->cta_link) }}" class="btn btn-primary" id="go-to-the-deals">{{ $negotiationGroup->endScreen->cta_text }}</a>
                    </div>
                    <div>
                        <a href="{{ $backLink }}" class="btn btn-link">Back</a>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <div class="py-5"></div>
@endsection

@push('footer-scripts')
    <script>
        dataLayer.push({'profile_quality': '{{ user()->profile->quality }}'});
    </script>
@endpush
