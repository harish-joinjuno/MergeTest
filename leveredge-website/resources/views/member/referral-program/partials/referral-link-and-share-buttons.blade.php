@php
    $message = Auth::user()->referral_link;
@endphp

@push('header-scripts')
<style>
    .copy-referral-link-input{
        background-color: #f2f2f2;
        height: 48px;
        color: black;
    }

    .share-button{
        height: 48px;
        width: 48px;
        text-align: center;
        margin-top: 24px;
        margin-left: 6px;
        margin-right: 6px;
        border-radius: 24px;
    }

    .share-icons{
        font-size: 24px;
    }

    #whatsapp-button{
        background-color: #25D366;
    }

    #email-button{
        background-color: #a8a8a8;
    }

    #facebook-button{
        background-color: #3b5998;
    }

    #linkedin-button{
        background-color: #0077B5;
    }

    #twitter-button{
        background-color: #38A1F3;
    }

    #whatsapp-button:hover{
        background-color: #25cd67;
        cursor: pointer;
    }

    #email-button:hover{
        background-color: #a2a2a2;
        cursor: pointer;
    }

    #facebook-button:hover{
        background-color: #3b5392;
        cursor: pointer;
    }

    #linkedin-button:hover{
        background-color: #006fad;
        cursor: pointer;
    }

    #twitter-button:hover{
        background-color: #379ced;
        cursor: pointer;
    }
</style>
@endpush

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <form>
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control copy-referral-link-input"
                        value="{{ Auth::user()->referral_link }}"
                        id="unique-url"
                        readonly
                    >
                    <div class="input-group-append">
                        <button class="btn btn-primary copy-button" type="button" data-clipboard-target="#unique-url"><i class="fa fa-copy"></i> &nbsp; Copy Link</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12 d-flex justify-content-center">

            <a
                id="whatsapp-button"
                href="https://api.whatsapp.com/send?text={{ rawurlencode($message) }}"
                class="share-button d-flex justify-content-center align-items-center"
                data-share-target="WhatsApp"
                title="Share on WhatsApp"
                target="_blank"
                rel="noreferrer noopener"
            >
                <span class="share-icons pointer-events-none">
                    <i class="fab fa-whatsapp text-white"></i>
                </span>
            </a>

            <a
                id="email-button"
                href="mailto:?&body={{ rawurlencode($message) }}"
                class="share-button d-flex justify-content-center align-items-center"
                data-share-target="Email"
                title="Share to Email"
                target="_blank"
                rel="noreferrer noopener"
            >
                <span class="share-icons pointer-events-none">
                    <i class="fas fa-envelope-open text-white"></i>
                </span>
            </a>

            <a
                id="facebook-button"
                href="https://www.facebook.com/sharer/sharer.php?u=https%3A//joinjuno.com"
                class="share-button d-flex justify-content-center align-items-center"
                data-share-target="Facebook"
                title="Share on Facebook"
                target="_blank"
                rel="noreferrer noopener"
            >
                <span class="share-icons pointer-events-none">
                    <i class="fab fa-facebook text-white"></i>
                </span>
            </a>

            <a
                id="linkedin-button"
                href="https://www.linkedin.com/sharing/share-offsite/?url=https%3A%2F%2Fjoinjuno.com"
                class="share-button d-flex justify-content-center align-items-center"
                data-share-target="LinkedIn"
                title="Share on Linked In"
                target="_blank"
                rel="noreferrer noopener"
            >
                <span class="share-icons pointer-events-none">
                    <i class="fab fa-linkedin text-white"></i>
                </span>
            </a>

            <a
                id="twitter-button"
                href="https://twitter.com/home?status=Juno%20uses%20group%20buying%20power%20to%20offer%20you%20low-interest%20rate%20loans!%20Learn%20more%20at%20https%3A//joinjuno.com"
                class="share-button d-flex justify-content-center align-items-center"
                data-share-target="Twitter"
                title="Share on Twitter"
                target="_blank"
                rel="noreferrer noopener"
            >
                <span class="share-icons pointer-events-none">
                    <i class="fab fa-twitter text-white"></i>
                </span>
            </a>

        </div>
    </div>
</div>

@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

    <script>
        new ClipboardJS('.copy-button');

        $("#whatsapp-button").click(function() {
            mixpanel.track('Social_share_pressed');
            window.location = "https://api.whatsapp.com/send?text={{ rawurlencode($message) }}";
            return false;
        });

        $("#email-button").click(function() {
            mixpanel.track('Social_share_pressed');
            window.location = "mailto:?&body={{ rawurlencode($message) }}";
            return false;
        });

        $("#twitter-button").click(function() {
            mixpanel.track('Social_share_pressed');
            window.location = "https://twitter.com/home?status=Juno%20uses%20group%20buying%20power%20to%20offer%20you%20low-interest%20rate%20loans!%20Learn%20more%20at%20https%3A//joinjuno.com";
            return false;
        });

        $("#facebook-button").click(function() {
            mixpanel.track('Social_share_pressed');
            window.location = "https://www.facebook.com/sharer/sharer.php?u=https%3A//joinjuno.com";
            return false;
        });

        $("#linkedin-button").click(function() {
            mixpanel.track('Social_share_pressed');
            window.location = "https://www.linkedin.com/sharing/share-offsite/?url=https%3A%2F%2Fjoinjuno.com";
            return false;
        });

    </script>
@endpush
