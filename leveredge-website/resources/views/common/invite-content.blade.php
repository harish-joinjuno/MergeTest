<div class="container mt-0 pt-0">
    <div class="row mt-5">
        <div class="col-md-12">
            <h2>Invite fellow students to join Juno</h2>
            <div class="separator"></div>

            <h4 class="mt--3 mb-5 common-question-heading">Juno is only successful when we have a large group of students to represent in our negotiations.</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h4 class="mb-3">Example message you can share</h4>
            <div class="card">
                <div class="card-body" id="text-for-sharing">
                    "{{ $message }}"
                </div>
                <button class="btn btn-primary copy-button" data-clipboard-target="#text-for-sharing">Copy to Clipboard</button>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h4 class="mb-3">Share with Friends</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mt-4">
            <div class="card social-card" id="whatsapp-card">
                <div class="card-body text-center">
                    <h1 class="whatsapp-color">
                        <i class="fab fa-whatsapp"></i>
                    </h1>
                    <p class="mt-2">
                        WhatsApp
                    </p>
                </div>
            </div>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mt-4">
            <div class="card social-card" id="email-card">
                <div class="card-body text-center">
                    <h1 class="email-color">
                        <i class="far fa-envelope"></i>
                    </h1>
                    <p class="mt-2">
                        Email
                    </p>
                </div>
            </div>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mt-4">
            <div class="card social-card" id="facebook-card">
                <div class="card-body text-center">
                    <h1 class="facebook-color">
                        <i class="fab fa-facebook"></i>
                    </h1>
                    <p class="mt-2">
                        Facebook
                    </p>
                </div>
            </div>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mt-4">
            <div class="card social-card" id="linkedin-card">
                <div class="card-body text-center">
                    <h1 class="linkedin-color">
                        <i class="fab fa-linkedin"></i>
                    </h1>
                    <p class="mt-2">
                        LinkedIn
                    </p>
                </div>
            </div>
        </div>

        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mt-4">
            <div class="card social-card" id="twitter-card">
                <div class="card-body text-center">
                    <h1 class="twitter-color">
                        <i class="fab fa-twitter"></i>
                    </h1>
                    <p class="mt-2">
                        Twitter
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h4 class="mb-3">Tips for Sharing Juno with friends</h4>

            <ol>
                <li>
                    Explain that joining Juno is risk-free and it could potentially save them a lot.
                </li>

                <li class="mt-3">
                    Some people are concerned about privacy - remind them that they only need to provide their name and email address. The rest of the information being asked is optional and they can skip it.
                </li>

                <li class="mt-3">
                    Add a personal text so your friends know it's from you, and encourage them to contact you with questions. People are usually wary of clicking unknown links.
                </li>

                <li class="mt-3">
                    Share your personal reasons for joining. Your recommendation as a friend is better than any polished text on the website.
                </li>
            </ol>

        </div>
    </div>
</div>


@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.copy-button');
    </script>


    <script>
        $("#whatsapp-card").click(function() {
            window.location = "https://api.whatsapp.com/send?text={{ rawurlencode($message) }}";
            return false;
        });


        $("#email-card").click(function() {
            window.location = "mailto:?&body={{ rawurlencode($message) }}";
            return false;
        });

        $("#twitter-card").click(function() {
            window.location = "https://twitter.com/home?status=Juno%20uses%20group%20buying%20power%20to%20offer%20you%20low-interest%20rate%20loans!%20Learn%20more%20at%20https%3A//joinjuno.com";
            return false;
        });

        $("#facebook-card").click(function() {
            window.location = "https://www.facebook.com/sharer/sharer.php?u=https%3A//joinjuno.com";
            return false;
        });

        $("#linkedin-card").click(function() {
            window.location = "https://www.linkedin.com/sharing/share-offsite/?url=https%3A%2F%2Fjoinjuno.com";
            return false;
        });

    </script>

@endpush

