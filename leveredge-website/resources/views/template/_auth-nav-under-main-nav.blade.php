<div class="container-fluid mt-5" id="auth-nav-under-main-nav">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link @if( str_contains(url()->current(), '/member/dashboard') ) active @endif" href="{{ url('/member/dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if( str_contains(url()->current(), '/member/referral-program') ) active @endif" href="{{ url('/member/referral-program') }}">Referral Program</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


@push('header-scripts')
    <style>
        #auth-nav-under-main-nav .active {
            text-underline: #0b0b0b;
        }
    </style>
@endpush
