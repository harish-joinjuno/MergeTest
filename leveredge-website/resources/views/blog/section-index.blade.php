@extends('blog.blog-template')

@section('content')
    <div class="container-fluid py-5">
        <div class="container narrow text-center my-5">
            <h1 class="mb-3 off-black">
                {{ $title }}
            </h1>
            <p class="px-lg-5">
                {!! $description !!}
            </p>
            <span
                class="d-inline-block"
                aria-hidden="true"
                style="width:480px;height:5px;background:#B2C8D8;max-width:75%;">
            </span>
        </div>
    </div>
    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="row align-items-stretch">
                @foreach($posts as $post)
                    <div class="d-flex flex-column col-12 col-sm-6 col-lg-4 mb-4">
                        <a
                            href="{{ route('blog.financial-literacy.post', $post->slug) }}"
                            class="d-block bg-white p-4 h-100 relative text-dark text-decoration-none"
                            aria-labelledby="{{ $post->slug }}_title"
                            aria-describedby="{{ $post->slug }}_description"
                        >
                            <h6
                                id="{{ $post->slug }}_title"
                                class="rounded-pill border border-{{ $post->type }} d-inline-block px-3 mb-4 bg-white"
                            >
                                {{ ucfirst($post->type) }}
                            </h6>
                            <h4
                                id="{{ $post->slug }}_description"
                                class="off-black clamp-2"
                            >
                                {{ $post->title }}
                            </h4>
                            <hr class="mt-2 line-divider border-{{ $post->type }}">
                            <p class="mb-5 clamp-4">
                                {{ $post->description }}
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
