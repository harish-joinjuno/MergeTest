@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const partnershipsBanner = document.querySelector('.partnerships-banner');
            const navButton = document.querySelector('.nav-button');
            window.addEventListener('scroll', function() {
                if (window.scrollY >= partnershipsBanner.offsetTop) {
                    navButton.classList.remove('d-none');
                } else {
                    navButton.classList.add('d-none');
                }
            });
        });
    </script>
@endpush

<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white" style="height:60px;">
    <div class="container py-1">
        <a class="navbar-brand mr-0 ml-n2 py-0" href="{{ url('/') }}">
            <img class="d-sm-none" src="{{ url('/img/logo/juno-logo.png') }}" height="40">
            <img class="d-none d-sm-block" src="{{ url('/img/logo/juno-logo-formerly.png') }}" height="30">
        </a>
        <a
            href="{{ url('/register') }}"
            class="btn btn-sm btn-secondary nav-button rounded-pill px-3 px-sm-5 font-weight-bold d-none fade-in"
        >
            Check my rate
        </a>
    </div>
</nav>
