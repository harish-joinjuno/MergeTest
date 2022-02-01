@extends('template.public')

@php /** @var \App\Scholarship $scholarship **/ @endphp

@section('content')

    <div class="py-3"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Test Scholarship Page</h3>
            </div>
        </div>
    </div>

    <!-- Example of using Scholarship Questions -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-lg-8">
                <h4>Questions attached to Scholarship</h4>
                <form method="post" action="{{ url('/scholarship/' . $scholarship->slug) }}">
                    @csrf
                    @foreach($scholarship->scholarshipQuestions as $scholarshipQuestion)
                        @php /** @var \App\ScholarshipQuestion $scholarshipQuestion **/ @endphp
                        @include('scholarship.question.' . $scholarshipQuestion->type)
                    @endforeach

                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Example of using Scholarship Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h4>Description Content Attached to Scholarship</h4>
                {!! isset($description) ? $description : 'Missing Description' !!}
            </div>
        </div>
    </div>

    <!-- Any other Content Attached to Scholarship -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h4>Any Other Content Attached to Scholarship</h4>
            </div>
        </div>

        @foreach($scholarship->scholarshipContents as $scholarshipContent)
            <div class="row mt-3">
                <div class="col-12">
                    <h4>{{ $scholarshipContent->name }}</h4>
                    {!! $scholarshipContent->body !!}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Example of using Scholarship Winners -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h4>List of Winners attached to scholarship</h4>
            </div>
        </div>
        <div class="row">
            @foreach($scholarship->scholarshipWinners as $winner)
                <div class="col-12 col-lg-6 mt-3">
                    <p>
                        Title: {{ $winner->title }}
                    </p>
                    <p>
                        Name: {{ $winner->name }}
                    </p>
                    <p>
                        University: {{ $winner->university }}
                    </p>
                    <p>
                        Year: {{ $winner->year }}
                    </p>
                    <p>
                        Photo:
                    </p>
                </div>

                <div class="col-12 offset-lg-2 col-lg-4 mt-3">
                    <img src="{{ $winner->photo }}" class="img-fluid">
                </div>
            @endforeach
        </div>
    </div>

    <div class="py-3"></div>
@endsection
