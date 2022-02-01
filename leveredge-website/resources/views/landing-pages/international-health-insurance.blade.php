@extends('landing-pages.landing-page-layout', [
    'pageHeading' => $pageHeading ?? 'A more affordable health insurance for internationals',
    'headingFlavorText' => $headingFlavorText ?? 'Save money on health insurance when you join for free',
    'callToActionURL' => $callToActionURL ?? '/register',
    'headingBackgroundImage' => $headingBackgroundImage ??  '/assets/images/green-balloon-background.png',
])

@section('page-body')
    @include('landing-pages.partials._static-image-text', [
        'image' => asset('/img/better-loans.png'),
        'heading' => 'More affordable than a university’s insurance plan',
        'description' => 'We did the math and you could save $1,000 - $3,000 per year. We also made sure the coverage
        meets your university requirements.',
        'alignRight' => true,
    ])

    @include('landing-pages.partials._static-image-text', [
        'image' => asset('/img/spring-season-with-check.png'),
        'heading' => 'Guaranteed University Acceptance of Waiver',
        'description' => 'GBG will refund any amount that you have paid for the plan if the university rejects
        your waiver request',
        'alignRight' => false,
        'bgLight' => true,
    ])
@endsection
