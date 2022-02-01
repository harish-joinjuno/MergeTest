@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles', [
        "headingBackgroundImage" => $headingBackgroundImage,
    ])
@endpush

@push('footer-scripts')
    <script>
        if(typeof(IntersectionObserver) != 'undefined') {
            const intersectionOptions = {
                rootMargin: '200px',
                threshold: 0.5,
            }
            const intersectionObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if(entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, intersectionOptions);

            const slideFadeIn = document.querySelectorAll('.slide-fade-in');
            slideFadeIn.forEach((element) => {
                intersectionObserver.observe(element);
            });
        }
    </script>
@endpush

@section('content')
    @if(!empty($alertBanner))
        <div class="container-fluid text-center text-white bg-primary py-2">
            {!! $alertBanner !!}
        </div>
    @endif

    @yield('pre-header')

    <header class="container-fluid pt-5">
        <div class="container banner px-0 {{ !empty($narrowHeading) ? 'narrow' : '' }} {{ $customBannerClasses ?? '' }}">
            <div class="col-12 {{ empty($centerHeading) ? 'col-lg-8' : '' }} px-0">
                <h1 class="{{ $headingColor ?? 'off-black' }} mb-5 {{ !empty($centerHeading) ? 'text-center' : '' }}">
                    {!! $pageHeading ?? '' !!}
                </h1>
                @if(empty($hideForm) || !$hideForm)
                    <form action="{{ $callToActionURL ?? url('/register') }}" class="pt-3">
                        <div class="form-group pr-lg-5">
                            <div class="text-box col-12 px-0">
                                <input
                                    type="text"
                                    name="email"
                                    placeholder="Enter your email"
                                    class="bg-light pl-3 pl-lg-5 pr-5"
                                />
                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="bg-secondary"
                                    >
                                        {{ $callToActionText ?? 'Sign up' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
                <p class="font-semibold {{ !empty($centerHeading) ? 'text-center' : '' }}">
                    {{ $headingFlavorText ?? '' }}
                </p>
                @yield('customCTA')
            </div>
        </div>
    </header>

    @yield('pre-body')

    @if(empty($hidePressBanner))
        @include('landing-pages.partials._press-banner')
    @endif

    @yield('page-body')

    @if(empty($hideBottom))
        @include('landing-pages.partials._faqs')
    @endif
    @if(isset($partnerShowScholarshipModule) && $partnerShowScholarshipModule)
        @include('partnerships._scholarship_container')
    @endif

    @yield('post-body')
@endsection
