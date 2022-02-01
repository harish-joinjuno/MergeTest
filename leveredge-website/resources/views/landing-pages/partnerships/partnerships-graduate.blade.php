@extends('landing-pages.graduate')

@section('pre-header')
    @if(!empty($partner))
        @include('landing-pages.partnerships._partnership-header', [
            'partner' => $partner,
        ])
    @endif

    <div class="container-fluid bg-light py-5">
        <div class="container narrow text-center my-5">
            <h4 class="underlined mb-5">
                What is Juno?
            </h4>
            <img
                src="{{ asset('/assets/images/timeline-img3.png')}}"
                alt="File with cheque"
                class="mb-5"
            >
            <h1 class="off-black mb-5">
                The first collective bargaining group for student loan refinancing.
            </h1>
            <p>
                Juno uses the power of group buying to negotiate
                <wbr>
                better deals on student loan refinancing.
                <br>
                It’s free to join, and if you do, you’re not committing to anything.
                <br>
                You always have the freedom to take our negotiated deal or go elsewhere.
            </p>
        </div>
    </div>
@endsection

