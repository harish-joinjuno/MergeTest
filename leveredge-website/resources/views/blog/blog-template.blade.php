@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')

    <style>
        h4.clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp:2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-height:2.4em;
        }
        p.clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp:4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-height:6em;
        }
        .line-divider {
            border-width:3px;
        }
        .border-article {
            border-color:#8FC3C0!important;
        }
        .border-video {
            border-color:#FFECBB!important;
        }
        .border-opinion {
            border-color:#FFD3E8!important;
        }
        .article-date {
            position:absolute;
            bottom:1em;
            left:2em;
        }
    </style>
@endpush
