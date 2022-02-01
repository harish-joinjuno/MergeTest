@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
    <style>
        .balloon-header {
            background-size:contain;
            background-repeat:no-repeat;
            background-position:right bottom;
            padding-bottom:25px;
            position:relative;
        }

        @media screen and (min-width:769px) {
            .balloon-header {
                padding-right:100px;
                background-image: url({{ asset('/img/pink-balloon-people-pulling-down-flipped.png') }});
            }
        }
    </style>
@endpush

@section('content')
    <div class="container my-md-5">
        <div class="flex-wrap">
            <section class="col-12 col-md-6 mb-lg-5 pb-0 float-left">
                <div class="balloon-header">
                    <h2 class="text-center mb-0">Student Loan Updates</h2>
                    <h4 class="text-secondary-green text-center mb-4">All in One Place</h4>

                    <p class="font-italic">
                        When do I need to start paying off my federal loans again? What’s going on with loan forgiveness?
                        <br>
                        Subscribe for free, real-time updates:
                    </p>

                    @if(empty(session('success')))
                        <form class="pt-3 mb-5 position-relative" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group pr-lg-5">
                                <div class="text-box col-12 px-0">
                                    <input
                                        type="text"
                                        name="email"
                                        placeholder="Enter your email"
                                        class="bg-light pl-3 pl-lg-5 pr-5"
                                        value="{{ old('email') }}"
                                    />
                                    <div class="input-group-append">
                                        <button
                                            type="submit"
                                            class="bg-secondary"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>


                            @error('email')
                                <span class="form-error position-absolute danger" style="top:100%;left:0;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </form>
                    @else
                        <div class="mb-5 pt-3" style="height:66px;">
                            <h5 class="text-secondary-green mb-0" style="line-height:50px;">
                                <i class="fas fa-check mx-2"></i>
                                Subscribed!
                            </h5>
                        </div>
                    @endif
                </div>

                @if(\Carbon\Carbon::parse($endDate)->greaterThan(\Carbon\Carbon::now()))
                    <div class="col-12 mb-2">
                        <div class="row align-items-center">
                            <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0)">
                                    <path d="M28.6987 6.08623V1.10771H9.51807V6.08623C9.51807 10.9345 11.9346 15.0935 15.3781 16.8691C16.151 17.2677 16.6438 18.0679 16.6438 18.9495V19.0505C16.6438 19.932 16.151 20.7323 15.3781 21.1308C11.9346 22.9064 9.51807 27.0654 9.51807 31.9137V36.8922H28.6987V31.9137C28.6987 27.0654 26.2822 22.9064 22.8387 21.1308C22.0658 20.7323 21.573 19.932 21.573 19.0505V18.9495C21.573 18.0679 22.0658 17.2677 22.8387 16.8691C26.2822 15.0936 28.6987 10.9345 28.6987 6.08623Z" fill="#EAF6FF"/>
                                    <path d="M22.8383 16.8691C26.2818 15.0935 28.6984 10.9345 28.6984 6.08623V1.10771H26.531V6.08623C26.531 10.9345 24.1145 15.0935 20.671 16.8691C19.8981 17.2677 19.4053 18.0679 19.4053 18.9495V19.0504C19.4053 19.932 19.8981 20.7323 20.671 21.1307C24.1145 22.9064 26.531 27.0653 26.531 31.9136V36.8921H28.6984V31.9136C28.6984 27.0653 26.2818 22.9064 22.8383 21.1307C22.0654 20.7322 21.5726 19.932 21.5726 19.0504V18.9495C21.5726 18.0679 22.0654 17.2677 22.8383 16.8691Z" fill="#D8ECFE"/>
                                    <path d="M19.0001 15.0609C20.7137 15.0258 22.3489 14.1609 23.6156 12.6153C24.6155 11.3953 25.2965 9.87503 25.6086 8.20682H12.3916C12.7037 9.87503 13.3847 11.3953 14.3846 12.6153C15.6513 14.1609 17.2866 15.0259 19.0001 15.0609Z" fill="#67B6B3"/>
                                    <path d="M27.615 4.51109V1.5511H9.51807V5.38435H26.5314L27.615 4.51109Z" fill="#D8ECFE"/>
                                    <path d="M26.5312 1.5511H28.6986V5.38435H26.5312V1.5511Z" fill="#C4E2FF"/>
                                    <path d="M30.2834 2.56136V1.27189C30.2834 0.56948 29.7237 0 29.0332 0H8.75014C8.05968 0 7.5 0.56948 7.5 1.27189V2.56129C7.5 3.26377 8.05968 3.83318 8.75014 3.83318H29.0332C29.7237 3.83325 30.2834 3.26377 30.2834 2.56136Z" fill="#CE825F"/>
                                    <path d="M29.4667 0H27.2993C27.9898 0 28.5495 0.56948 28.5495 1.27189V2.56129C28.5495 3.26377 27.9898 3.83318 27.2993 3.83318H29.4667C30.1571 3.83318 30.7168 3.2637 30.7168 2.56129V1.27189C30.7168 0.56948 30.1571 0 29.4667 0V0Z" fill="#B65E4C"/>
                                    <path d="M19.6815 19.3622C19.6815 19.04 19.4248 18.7788 19.1081 18.7788C18.7913 18.7788 18.5347 19.04 18.5347 19.3622V19.6733C18.5347 19.9956 18.7914 20.2567 19.1081 20.2567C19.4248 20.2567 19.6815 19.9956 19.6815 19.6733V19.3622Z" fill="#67B6B3"/>
                                    <path d="M19.6815 17.0103C19.6815 16.6882 19.4248 16.4269 19.1081 16.4269C18.7913 16.4269 18.5347 16.6881 18.5347 17.0103V17.3215C18.5347 17.6437 18.7914 17.905 19.1081 17.905C19.4248 17.905 19.6815 17.6438 19.6815 17.3215V17.0103Z" fill="#67B6B3"/>
                                    <path d="M19.6815 24.066C19.6815 23.7438 19.4248 23.4825 19.1081 23.4825C18.7913 23.4825 18.5347 23.7438 18.5347 24.066V24.3771C18.5347 24.6993 18.7914 24.9605 19.1081 24.9605C19.4248 24.9605 19.6815 24.6993 19.6815 24.3771V24.066Z" fill="#67B6B3"/>
                                    <path d="M19.6815 21.7141C19.6815 21.3919 19.4248 21.1307 19.1081 21.1307C18.7913 21.1307 18.5347 21.3919 18.5347 21.7141V22.0253C18.5347 22.3475 18.7914 22.6087 19.1081 22.6087C19.4248 22.6087 19.6815 22.3476 19.6815 22.0253V21.7141Z" fill="#67B6B3"/>
                                    <path d="M23.8321 28.1544C22.5387 27.0096 20.8611 26.3791 19.1082 26.3791C17.3554 26.3791 15.6777 27.0096 14.3844 28.1544C12.9737 29.4031 12.1968 31.0851 12.1968 32.8908V34.1668V35.2475H26.0197V34.1668V32.8908C26.0197 31.0851 25.2429 29.4031 23.8321 28.1544Z" fill="#67B6B3"/>
                                    <path d="M30.2833 36.7281V35.4387C30.2833 34.7362 29.7236 34.1668 29.0332 34.1668H8.53334C7.84289 34.1668 7.2832 34.7363 7.2832 35.4387V36.7281C7.2832 37.4306 7.84289 38 8.53334 38H29.0332C29.7235 38 30.2833 37.4305 30.2833 36.7281Z" fill="#AA6A51"/>
                                    <path d="M30.5001 36.7281V35.4387C30.5001 34.7362 29.9404 34.1668 29.25 34.1668H8.75014C8.05968 34.1668 7.5 34.7363 7.5 35.4387V36.7281C7.5 37.4306 8.05968 38 8.75014 38H29.25C29.9404 38 30.5001 37.4305 30.5001 36.7281Z" fill="#AA6A51"/>
                                    <path d="M30.2833 36.7281V35.4387C30.2833 34.7362 29.7236 34.1668 29.0332 34.1668H8.53334C7.84289 34.1668 7.2832 34.7363 7.2832 35.4387V36.7281C7.2832 37.4306 7.84289 38 8.53334 38H29.0332C29.7235 38 30.2833 37.4305 30.2833 36.7281Z" fill="#AA6A51"/>
                                    <path d="M30.2833 36.7281V35.4387C30.2833 34.7362 29.7236 34.1668 29.0332 34.1668H8.53334C7.84289 34.1668 7.2832 34.7363 7.2832 35.4387V36.7281C7.2832 37.4306 7.84289 38 8.53334 38H29.0332C29.7235 38 30.2833 37.4305 30.2833 36.7281Z" fill="#CE825F"/>
                                    <path d="M29.4667 34.1668H27.2993C27.9898 34.1668 28.5495 34.7362 28.5495 35.4386V36.728C28.5495 37.4305 27.9898 37.9999 27.2993 37.9999H29.4667C30.1571 37.9999 30.7168 37.4305 30.7168 36.728V35.4387C30.7168 34.7362 30.1571 34.1668 29.4667 34.1668Z" fill="#B65E4C"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="38" height="38" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <h5 class="text-secondary-green mb-0 ml-4 font-semibold">
                                {{ \Carbon\Carbon::parse($endDate)->diffInDays() }} days until
                            </h5>
                        </div>
                    </div>
                    <p class="text-muted small">
                        Current Documented End to 0% Interest, per Dept. of Ed.
                    </p>
                @endif
            </section>

            <section class="col-12 col-md-6 pl-md-5 pt-3 float-right">
                <h5 class="font-semibold mb-4">Latest Updates</h5>

                @foreach($updates as $update)
                    <article class="my-4 pb-3 border-bottom">
                        <span class="small bg-light-green py-2 px-3 rounded-pill text-secondary-green">
                            <i class="fal fa-calendar mr-2"></i>
                            {{ $update->posted_at->format('j M y') }}
                        </span>
                        <h6 class="font-weight-bold mt-3">{{ $update->title }}</h6>
                        <p class="text-muted">
                            {!! $update->description !!}
                        </p>
                        <a
                            href="{{ $update->source }}"
                            rel="noopener noreferrer"
                            target="_blank"
                            class="text-primary font-weight-bold"
                        >
                            Source
                            <i class="fal fa-external-link ml-4"></i>
                        </a>
                    </article>
                @endforeach
            </section>

            <section class="col-12 col-md-6 float-left">
                <div class="pr-lg-5">
                    <div class="col-12 bg-light-green p-4 rounded-top">
                        <h5 class="mb-0 text-secondary-green font-semibold">FAQ</h5>
                    </div>

                    <div class="col-12 bg-light rounded-bottom">
                        @foreach($faqs as $faq)
                            @include('landing-pages.partials._dropdown', [
                                'trigger' => $faq['question'],
                                'content' => $faq['answer'],
                            ])
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
