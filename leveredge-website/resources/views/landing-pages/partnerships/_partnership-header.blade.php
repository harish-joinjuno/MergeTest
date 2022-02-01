@push('header-scripts')
    <style>
        .banner-logo {
            max-height:75px;
            max-width:100%;
            width:auto;
        }

        @media screen and (max-width:768px) {
            .banner-logo {
                max-height:40px;
            }
        }
    </style>
@endpush

<div class="container-fluid">
    <div class="container narrow mt-5">
        <div class="row align-items-center">
            <div class="col text-center text-md-right px-0 px-md-3">
                <img
                    src="{{ asset($partner['logo']) }}"
                    class="banner-logo"
                >
            </div>
            <div class="col-auto text-center p-3">
                <svg
                    aria-hidden="true"
                    focusable="false"
                    role="img"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 352 512"
                    height="30"
                    width="30"
                    class="text-muted"
                >
                    <path
                        fill="currentColor"
                        d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19
                                0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93
                                89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28
                                256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48
                                0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28
                               12.28-32.19 0-44.48L242.72 256z"
                    ></path>
                </svg>
            </div>
            <div class="col text-center text-md-left px-0 px-md-3">
                <img
                    src="{{ asset('/img/logo/juno-logo.png') }}"
                    class="banner-logo"
                >
            </div>
        </div>
        @if(!empty($partner['description']))
            <div class="row mt-5 mb-5">
                <div class="col">
                    <h5 class="text-center">
                        {!! $partner['description'] !!}
                    </h5>
                </div>
            </div>
        @endif
    </div>
</div>
