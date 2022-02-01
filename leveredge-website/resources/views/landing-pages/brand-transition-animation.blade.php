@push('header-scripts')
    <style>
        .brand-transition {
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            z-index:2000;
            background-color:#fff;
        }
        .leveredge-logo, .juno-logo {
            max-width:225px;
        }
        .leveredge-logo, .juno-logo, .arrow, .continue, .flavor-text {
            display:none;
        }
        .fade-in {
            display:inline-block;
            transform-origin:top center;
            animation-name:fadeIn;
            animation-iteration-count:1;
            animation-duration:1s;
        }
        .fade-out {
            animation-name:fadeOut;
            animation-iteration-count:1;
            animation-duration:1s;
        }
        .logos-container {
            min-height:100px;
            min-width:100%;
        }
        .headings-container {
            min-height:250px;
            min-width:100%;
        }
        .flavor-text {
            min-width:100%;
        }
        .button-container {
            min-height:50px;
        }
        @keyframes fadeIn {
            from {
                opacity:0;
                transform:scale(.95);
            }
            to {
                opacity:1;
                transform:scale(1);
            }
        }
        @keyframes fadeOut {
            from {
                opacity:1;
            }
            to {
                opacity:0;
            }
        }
        @media screen and (max-width:767px) {
            .arrow-outer {
                transform:rotate(90deg);
            }
            .logos-container {
                min-height:33%;
            }
            .logos-container div {
                height:33%;
            }
            .headings-container {
                min-height:33%;
            }
            .button-container {
                min-height:50px;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const leveredgeLogo = document.querySelector('.leveredge-logo');
            const arrow = document.querySelector('.arrow');
            const junoLogo = document.querySelector('.juno-logo');
            const mainHeading = document.querySelector('.main-heading');
            const flavorText = document.querySelector('.flavor-text');
            const continueButton = document.querySelector('.continue');
            const brandTransition = document.querySelector('.brand-transition');
            document.body.classList.add('overflow-hidden');
            let count = 0;
            const elements = [leveredgeLogo, arrow, junoLogo, mainHeading, flavorText, continueButton];
            const fadeInInterval = setInterval(function() {
                const item = elements[count];
                if(item) {
                    if(item.classList.contains('main-heading')) {
                        item.classList.add('fade-out');
                        setTimeout(function() {
                            item.classList.add('d-none');
                        }, 990);
                    } else {
                        item.classList.add('fade-in');
                    }
                } else {
                    clearInterval(fadeInInterval);
                    setTimeout(function() {
                        brandTransition.classList.add('d-none');
                        document.body.classList.remove('overflow-hidden');
                    }, 7500);
                }
                count += 1;
            }, 1000);
            continueButton.addEventListener('click', function() {
                brandTransition.classList.add('d-none');
                document.body.classList.remove('overflow-hidden');
            });
        });
    </script>
@endpush

<div class="container-fluid brand-transition" aria-hidden="true">
    <div class="row min-vh-100 justify-content-center align-items-stretch">
        <div class="col d-flex flex-column text-center align-items-center justify-content-center" style="max-width:640px;">
            <div class="row text-center logos-container justify-content-center align-items-center mb-5">
                <div class="col-12 col-sm-4 px-0">
                    <img
                        class="leveredge-logo img-fluid"
                        src="{{ asset('/img/logo/logo-desktop-white.png') }}"
                    >
                </div>
                <div class="col-12 col-sm-4 px-0">
                    <span class="arrow-outer d-inline-block">
                        <svg
                            aria-hidden="true"
                            focusable="false"
                            role="img"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"
                            height="50"
                            width="50"
                            class="mx-5 arrow"
                            style="color:#ccc;"
                        >
                            <path
                                fill="currentColor"
                                d="M295.515 115.716l-19.626 19.626c-4.753 4.753-4.675 12.484.173
                        17.14L356.78 230H12c-6.627 0-12 5.373-12 12v28c0 6.627 5.373 12 12 12h344.78l-80.717
                        77.518c-4.849 4.656-4.927 12.387-.173 17.14l19.626 19.626c4.686 4.686 12.284 4.686 16.971
                        0l131.799-131.799c4.686-4.686 4.686-12.284 0-16.971L312.485
                        115.716c-4.686-4.686-12.284-4.686-16.97 0z"
                            ></path>
                        </svg>
                    </span>
                </div>
                <div class="col-12 col-sm-4 px-0">
                    <img
                        class="juno-logo img-fluid"
                        src="{{ asset('/img/logo/juno-logo.png') }}"
                    >
                </div>
            </div>
            <div class="headings-container d-block">
                <h1 class="off-black mb-5 main-heading">
                    LeverEdge is now Juno
                </h1>
                <h4 class="px-2 px-sm-5 py-5 rounded flavor-text mb-5" style="background-color:#f1f7ff;">
                    <strong>Same great rates, <br>same great company, <br>more pronounceable name.</strong>
                </h4>
            </div>
            <div class="button-container">
                <button class="btn btn-secondary px-5 continue font-weight-bold rounded-pill">
                    Continue
                </button>
            </div>
        </div>
    </div>
</div>
