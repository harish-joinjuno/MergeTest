@push('header-scripts')
    <style>
        .social-button-link {
            height:35px;
            width:35px;
            padding:0;
            line-height:34px;
            font-size:20px;
            border-radius:5px;
        }

        .flavor-image {
            max-width:100%;
        }

        .timeline-step {
            position:relative;
            min-width:125px;
        }

        .timeline-step:not(:last-of-type):after {
            content: '';
            position:absolute;
            width:100%;
            height:1px;
            background:#2F706B;
            bottom:49px;
            z-index:0;
        }

        .timeline-step i {
            color:#E7E8E7;
        }

        .timeline-step i {
            color:#488C89;
        }

        .timeline-step:after {
            background:#488C89;
        }

        @media screen and (min-width:768px) {
            .flavor-image {
                position:absolute;
                background-position:left;
                background-size:150%;
                background-repeat:no-repeat;
                top:50%;
                left:-50px;
                width:650px;
                max-width:none;
                transform:translateY(-50%);
            }

            .timeline-step {
                min-width:auto;
            }
        }
    </style>
@endpush

@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyAndShareButton = document.getElementById('copyButton');
            const copyAndShareInput = document.getElementById('copyInput');
            const oldTitle = copyAndShareButton.title;

            copyAndShareButton.addEventListener('click', function() {
                copyAndShareInput.select();
                document.execCommand('copy');
                $(copyAndShareButton)
                    .attr('data-original-title', 'Copied to Clipboard!')
                    .tooltip('show');

                setTimeout(function() {
                    copyAndShareInput.blur();
                    copyAndShareButton.blur();
                    $(copyAndShareButton)
                        .attr('data-original-title', oldTitle)
                        .tooltip('show');

                    mixpanel.track('Copy_link_pressed');
                }, 2500);
            });
        });
    </script>
@endpush

<h1 class="mb-4">
    {{ $mainHeading ?? '' }}
</h1>
<p>
    {{ $flavorDescription ?? '' }}
</p>
<h5 class="mb-5 font-weight-bold">
    {!! $subHeading ?? '' !!}
</h5>
<p>
    {{ $optionalText ?? '' }}
</p>
<div class="row justify-content-center mb-5">
    <div class="col-12 col-sm-8">
        <div class="input-group mb-5">
            <input
                id="copyInput"
                type="text"
                class="form-control"
                placeholder="Referral Link"
                aria-label="Referral Link"
                aria-describedby="copyButton"
                value="{{ $shareUrl }}"
                readonly
            >
            <div class="input-group-append">
                <button
                    id="copyButton"
                    class="btn btn-secondary-green btn-sm"
                    type="button"
                    data-share-target="Copy"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Copy the URL"
                >
                    <i class="fas fa-copy"></i> <span class="d-none d-sm-inline ml-2">Copy Link</span>
                </button>
            </div>
        </div>

        <a
            href="https://api.whatsapp.com/send?phone=&text={{ urlencode($shareTitle . ' ' . $shareUrl) }}"
            class="btn btn-sm text-white social-button-link mx-2"
            target="_blank"
            style="background: #27D346;"
            onClick="mixpanel.track('WhatsApp_pressed')"
            data-share-target="WhatsApp"
        >
            <i class="fab fa-whatsapp"></i>
        </a>
        <a
            href="https://twitter.com/intent/tweet?text={{ urlencode($shareTitle) }}&url={{ urlencode($shareUrl) }}"
            target="_blank"
            class="btn btn-sm text-white social-button-link mx-1"
            style="background: #0084B4;"
            onClick="mixpanel.track('Twitter_pressed')"
            data-share-target="Twitter"
        >
            <i class="fab fa-twitter"></i>
        </a>
        <a
            href="mailto:?subject={{ urlencode($shareTitle) }}&body={{ urlencode($shareUrl) }}"
            class="btn btn-sm text-white bg-primary social-button-link mx-1"
            target="_blank"
            onClick="mixpanel.track('Email_pressed')"
            data-share-target="Email"
        >
            <i class="fas fa-envelope"></i>
        </a>
        <a
            href="https://www.facebook.com/dialog/share?app_id=2142075722511834&display=popup&href={{ urlencode($shareUrl) }}&quote={{ urlencode($shareTitle) }}"
            class="btn btn-sm text-white social-button-link mx-1"
            target="_blank"
            style="background: #3B5998;"
            onClick="mixpanel.track('FB_pressed')"
            data-share-target="Facebook"
        >
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($shareUrl) }}&title={{ urlencode($shareTitle) }}"
           class="btn btn-sm text-white social-button-link mx-1"
           target="_blank"
           style="background: #2867B2;"
           onClick="mixpanel.track('Linkedin_pressed')"
           data-share-target="LinkedIn"
        >
            <i class="fab fa-linkedin-in"></i>
        </a>
    </div>
</div>

@if( !empty($showMilestonePrizes) && $showMilestonePrizes )
@php
    $rewards = [
        '1' => asset('/img/referral-prizes/leveredge-t-shirt-square.jpg'),
        '5' => asset('/img/referral-prizes/herschel-backpack-square.jpg'),
        '10' => asset('/img/referral-prizes/apple-air-pods-medium.png'),
        '25' => asset('/img/referral-prizes/apple-watch-medium.png'),
        '50' => asset('/img/referral-prizes/3k-cash-square.png'),
        '100' => asset('/img/referral-prizes/10k-cash-square.png'),
        '500' => asset('/img/referral-prizes/tuition-square.png'),
    ];
@endphp

<div class="row text-center mx-0 mt-5 overflow-auto flex-nowrap">
    @foreach($rewards as $label => $image)
        <div class="col px-2 timeline-step">
            <img
                src="{{ $image }}"
                class="img-fluid mb-3"
                alt="{{ $label }} Referrals Reward"
            >
            <i
                class="fas fa-circle bg-white text-primary position-relative"
                style="font-size:12px;"
            ></i>
            <p class="text-dark small">
                {{ $label }}
            </p>
        </div>
    @endforeach
</div>
@endif
