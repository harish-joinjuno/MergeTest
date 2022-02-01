@extends('blog.blog-template')

@section('content')
    <div class="container-fluid py-5">
        <div class="container narrow text-center my-5">
            <h1 class="mb-3 off-black">
                Press
            </h1>
            <p class="px-lg-5">
                Read about us in the news
            </p>
            <span
                class="d-inline-block"
                aria-hidden="true"
                style="width:480px;height:5px;background:#B2C8D8;max-width:75%;">
            </span>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            @foreach($presses as $press)
                <div class="d-flex flex-column col-12 col-sm-6 col-lg-4 mb-4">
                    <a
                        href="{{ $press->url }}"
                        class="d-block bg-white p-4 h-100 relative text-dark text-decoration-none"
                        aria-labelledby="{{ $press->id }}_title"
                        aria-describedby="{{ $press->id }}_description"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <h4
                            id="{{ $press->id }}_description"
                            class="off-black clamp-2"
                        >
                             {{ $press->publisher }}
                        </h4>
                        <hr class="mt-2 line-divider border-article">
                        <p class="mb-5 clamp-4">
                            {{ $press->title }}
                        </p>
                        <p class="small text-muted text-right">
                            {{ \Carbon\Carbon::parse($press->date_published)->toFormattedDateString() }}
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="py-5"></div>
@endsection


