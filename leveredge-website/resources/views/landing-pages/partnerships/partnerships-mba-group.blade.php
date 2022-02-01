@extends('landing-pages.group.group', [
    'dealLink' => url('/loans/graduate'),
    'heading'  => 'Get a better deal<br>on MBA student loans for fall 2021.',
    'total_applications'     => 6000,
    'completed_applications' => \App\NegotiationGroup::find(\App\NegotiationGroup::NG_MBA_21_22)->users_count + 50,
    'days_to_go'             => \Carbon\Carbon::now()->diffInDays('Apr 15, 2021'),
])

@push('below-nav')
    <div class="container-fluid mb-5">
        @include('landing-pages.partnerships._partnership-header', [
            'partner' => $partner,
        ])
    </div>
@endpush
