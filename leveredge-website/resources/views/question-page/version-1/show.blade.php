@extends('template.public')

@section('content')

    @php
        /** @var \App\QuestionPage $questionPage */
    @endphp

    @include('landing-pages.partials._select-2-injection')

    <form id="questionForm" method="post">
        @csrf

        <div class="py-3 py-lg-4"></div>

        <div class="container">
            @if($questionPage->content()->get('title'))
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 text-center">
                    <h2>{!! $questionPage->content()->get('title') !!}</h2>
                </div>
            </div>
            @endif

            @if($questionPage->content()->get('sub-heading'))
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <p class="font-semibold">{!! $questionPage->content()->get('sub-heading') !!}</p>
                </div>
            </div>
            @endif
        </div>

        @include('question-page.version-1.embed')

        @if($questionPage->content()->get('content-below-question'))
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {{ $questionPage->content()->get('content-below-question') }}
                </div>
            </div>
        </div>
        @endif

    </form>

    <div class="py-5"></div>

@endsection
