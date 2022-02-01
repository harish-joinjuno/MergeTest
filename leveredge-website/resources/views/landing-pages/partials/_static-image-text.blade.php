<div class="container-fluid py-3 {{ !empty($bgLight) ? 'bg-light' : '' }}">
    <div class="container">
        <div class="row align-items-center text-center text-md-left py-5">
            <div class="col-12 col-md-5 text-center {{ !empty($alignRight) ? 'order-md-2' : '' }}">
                @if(empty($video))
                <img
                    src="{{ $image }}"
                    style="max-width:250px;width:100%;height:auto;"
                >
                @else
                    <div
                        class="img-box video-box"
                        style="background:url({{ $image }}) no-repeat center/cover;"
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
                @endif
            </div>
            <div class="col-12 col-md-7 {{ !empty($alignRight) ? 'order-md-1 text-center text-md-left' : '' }}">
                <span class="d-block d-md-none divider"></span>
                @if(empty($h2))
                    <h1 class="off-black mb-3">{{ $heading }}</h1>
                @else
                    <h2 class="off-black mb-3">{{ $heading }}</h2>
                @endif
                <p>
                    {!! $description !!}
                </p>
            </div>
        </div>
    </div>
</div>

@if(!empty($video))
    @include('landing-pages.partials._video-dialog', [
        'youtubeId' => 'Afsb5dD44_c',
    ])
@endif
