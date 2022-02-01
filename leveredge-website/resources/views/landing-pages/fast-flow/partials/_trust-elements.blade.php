@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@if(empty($hideHeader))
    @include('landing-pages.fast-flow.partials._email-form', [
        'heading' => 'We negotiated this deal for our community. Now we’re sharing it with the world for free.',
        'subheading' => 'If you continue without providing this information you may not receive the discount.',
        'formDisclaimer' => '*If you skip, you may not receive our discount.',
    ])
@endif

@include('landing-pages.partials._press-banner')

@include('landing-pages.partials._static-image-text', [
    'image' => asset('/img/summer-season-with-check.png'),
    'heading' => 'Through collective bargaining, we made lenders give us a better deal. It’s refinancing with a volume discount.',
    'description' => 'Thanks to 40,000+ people, we successfully negotiated a better deal for everyone. ',
    'alignRight' => true,
    'h2' => true,
])

@include('landing-pages.partials._static-image-text', [
    'image' => asset('/img/testimonial-thumbnail.png'),
    'video' => 'youtubeId',
    'heading' => 'Hear from our members',
    'description' => 'Hear from Donato Clay, Yale EMBA ’21, on comparing his options with Juno for his
    third graduate degree.',
    'alignRight' => false,
    'bgLight' => true,
    'h2' => true,
])

@include('landing-pages.partials._static-image-text', [
    'image' => asset('/img/selfless.png'),
    'heading' => 'Our community has already earned more than $427,000 in cash back this year. ',
    'description' => 'We’re also pushing forward the best future by doing financial literacy outreach and providing
    members scholarship opportunities.',
    'alignRight' => true,
    'h2' => true,
])
