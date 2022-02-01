@extends('template.public')

@section('content')
    <div id="press-release" class="d-flex flex-column">
        @include('press_releases.header')
        <div class="container release-container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    @foreach($releasesGroup as $key => $releases)
                        <div class="release-group">
                            <h3 class="release-group-title off-black">{{ $key }}</h3>
                            @foreach($releases as $release)
                                <div class="release my-4">
                                    <div class="date off-black">
                                        <span>{{ Carbon\Carbon::parse($release->date)->format('F, jS') }}</span>
                                    </div>
                                    <a class="tertiary-green" href="{{ route('press-releases-detailed', $release->id) }}">
                                        <span>{{$release->title}}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('press_releases.footer')
    </div>

@endsection

@push('header-scripts')
    <link href="{{mix('mix/css/pages/press-release.css')}}" rel="stylesheet" type="text/css">
@endpush

