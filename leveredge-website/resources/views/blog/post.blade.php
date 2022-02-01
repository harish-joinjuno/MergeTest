@extends('blog.blog-template')

@push('header-scripts')
    <style>
        .blog-post-body figure {
            text-align:center;
        }
        .blog-post-body figure img {
            max-width:100%;
            height:auto;
            margin:0 auto;
        }
    </style>
@endpush

@section('content')
    @if(!empty($backUrl))
        <div class="container py-3">
            <a
                href="{{ $backUrl }}"
                class="text-dark"
            >
                <i class="fal fa-chevron-left mr-2" style="font-size:12px;"></i>
                {{ $backText ?? 'Back to Home' }}
            </a>
        </div>
    @endif
    <div class="container-fluid py-5 blog-post-body">
        <div class="container narrow text-center my-5">
            <h1 class="off-black mb-4">{{ $post->title }}</h1>
            <p class="mb-0 text-muted">
                {{ $post->date ?? '' }}
            </p>
            <span
                class="d-inline-block border-{{ $post->type }}"
                aria-hidden="true"
                style="width:480px;border-top:5px solid;max-width:75%;">
            </span>
        </div>
        <div class="container narrow my-5">
            @if($post->type === 'video')
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 p-0 d-flex flex-column justify-content-center mb-5">
                        <div
                            class="img-box video-box widescreen"
                            style="background:url({{  Storage::disk('s3_app_public')->url($post->video_thumbnail) }}) no-repeat center/cover;"
                            role="button"
                            tabindex="0"
                            data-toggle="modal"
                            data-target="#videoModal"
                        >
                            <div class="absolute-center p-5 bg-black text-center">
                            <span
                                class="d-inline-block play-button rounded-circle cursor-pointer"
                            >
                                <svg
                                    aria-hidden="true"
                                    focusable="false"
                                    role="img"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0
                                        37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"
                                    ></path>
                                </svg>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>

                @include('landing-pages.partials._video-dialog', [
                    'youtubeId' => $post->video_id,
                ])
            @else
                {!! nl2br($post->content) !!}
            @endif

            <div aria-hidden="true" class="pt-5"></div>


            @if(!empty($backUrl))
                <a
                    href="{{ $backUrl }}"
                    class="text-dark d-block mt-5"
                >
                    <i class="fal fa-chevron-left mr-2" style="font-size:12px;"></i>
                    {{ $backText ?? 'Back to Home' }}
                </a>
            @endif
        </div>
    </div>
@endsection
