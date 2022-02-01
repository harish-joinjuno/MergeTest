@if(empty($hideWhyJuno))
    <div class="container-fluid py-5" style="margin-top:-190px;">
        <div class="container pb-5">
            <div class="row pb-5">
                <div class="col-12 text-right">
                    <img
                        src="{{ asset('/img/students-walking-away.png') }}"
                        aria-hidden="true"
                        style="max-width:200px;margin-right:25%;"
                    >
                </div>
            </div>
            <h4 class="underlined text-center my-5">Why Juno?</h4>
        </div>
    </div>
@endif

@php
    $staticSections = $staticSections ?? [
        [
          'img' => asset('/img/hands-on-laptop.png'),
          'title' => 'Free, Fast and Easy',
          'text' => 'Signing up is free and takes less than 1 minute. We don’t run a credit check and don’t need your
          social security number.',
          'background' => 'bg-light-green',
        ],
        [
          'img' => asset('/img/better-loans.png'),
          'title' => 'Better Loans',
          'text' => 'Months of research and the competitive process ensure that our members get the best
          rates in the market and you’re always free to compare yourself!',
          'background' => 'bg-light',
        ],
        [
          'img' => asset('/img/hands-on-laptop.png'),
          'title' => 'Together',
          'text' => 'Invite those you care about and help the negotiation be successful. The larger the group,
          the better our chances of success. You\'ll also get rewarded for helping the group succeed.',
          'background' => 'bg-light-green',
        ],
        [
          'img' => asset('/img/transparent.png'),
          'title' => 'Transparent',
          'text' => 'We will keep you informed through the entire process so you can make informed decisions
          about financing your education.',
          'background' => 'bg-light',
        ],
    ];
@endphp

@foreach($staticSections as $staticSection)
    <div class="container-fluid text-center py-5 {{ $staticSection['background'] ?? '' }}">
        <img
            style="max-width:250px;margin-top:-175px;"
            src="{{ $staticSection['img'] ?? asset('/img/hands-on-laptop.png') }}"
            aria-hidden="true"
            class="slide-fade-in"
        >
        <div class="container narrow" style="padding:50px 0;">
            <h1>{{ $staticSection['title'] ?? '' }}</h1>
            <p class="mb-5">{{ $staticSection['text'] ?? '' }}</p>
        </div>
    </div>
@endforeach
