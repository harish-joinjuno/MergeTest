@extends('template.public')

@section('content')

    <div class="py-5"></div>

    @hasPageSection(\App\PageSection::PAGE_ELIGIBILITY,'Above universities image')
    @php
        $aboveImageSection = \App\PageSection::query()
                    ->where('target_page', '=', \App\PageSection::PAGE_ELIGIBILITY)
                    ->where('section_name', '=', 'Above universities image')
                    ->first();
    @endphp
    @endif

    @hasPageSection(\App\PageSection::PAGE_ELIGIBILITY,'Below universities image')
    @php
        $belowImageSection = \App\PageSection::query()
                    ->where('target_page', '=', \App\PageSection::PAGE_ELIGIBILITY)
                    ->where('section_name', '=', 'Below universities image')
                    ->first();
    @endphp
    @endif


    @hasPageSection(\App\PageSection::PAGE_ELIGIBILITY,'Above universities image')
    <div class="container">
        <div class="row">
            <div class="col">
                {!! $aboveImageSection->published_content !!}
            </div>
        </div>
    </div>
    @endif

    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('/img/students-pulling-eligibility.png') }}" class="img-fluid d-none d-lg-inline-block" />
                <img src="{{ asset('/img/students-pulling-eligibility-mobile.png') }}" class="img-fluid d-lg-none" />
            </div>
        </div>
    </div>

    @hasPageSection(\App\PageSection::PAGE_ELIGIBILITY,'Below universities image')
    <div class="container">
        <div class="row">
            <div class="col">
                {!! $belowImageSection->published_content !!}
            </div>
        </div>
    </div>

    <div class="py-5"></div>
    @endif
@endsection
