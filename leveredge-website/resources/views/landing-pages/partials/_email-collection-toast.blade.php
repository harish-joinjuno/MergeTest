@push('header-scripts')
    <style>
        .email-toast {
            position:fixed;
            bottom:0;
            right:150px;
            z-index:1040;
            width:480px;
            max-width:95%;
            transform:translate(0, 100%) scale(.8);
            transition:transform .75s ease-in-out;
            will-change:transform;
            border-radius:5px 5px 0 0;
        }

        .email-toast.see-more {
            transform:translate(0, 63%) scale(.8);
        }

        .email-toast.active {
            transform:translate(0, 0) scale(1);
        }

        .email-toast span.close-email-toast {
            position:absolute;
            cursor:pointer;
            top:5px;
            right:5px;
            width:40px;
            height:40px;
            z-index:10;
        }

        .email-toast span.close-email-toast i {
            pointer-events:none;
        }

        .email-toast .success-message {
            position:absolute;
            display:flex;
            top:0;
            left:0;
            bottom:0;
            right:0;
            z-index:10;
        }

        @media screen and (max-width:768px) {
            .email-toast {
                right:2.5%;
            }

            .email-toast.see-more:not(.active) {
                transform:translate(0, 66%) scale(.8);
            }
        }

        @media screen and (max-width:320px) {
            .email-toast {
                padding:1em!important;
            }

            .email-toast.see-more:not(.active) {
                transform:translate(0, 70%) scale(.8);
            }
        }
    </style>
@endpush

@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailToast = document.querySelector('.email-toast');
            if (emailToast != null) {
                initToast(emailToast);
            }
        });

        function initToast(emailToast) {
            const seeMoreButton = emailToast.querySelector('.see-more-button');
            // Open the toast after a timer
            setTimeout(function() {
                emailToast.classList.add('see-more');
            }, 5000);

            // Delegate a click event to any item with the close-email-toast class to close the toast
            document.addEventListener('click', function(event) {
                if (event.target) {
                    if(event.target.matches('.close-email-toast')) {
                        emailToast.classList.remove('active', 'see-more');
                    }
                    if(event.target.matches('.see-more-button')) {
                        emailToast.classList.add('active');
                        seeMoreButton.classList.add('d-none');
                    }
                }
            });

            initEmailForm(emailToast);
        }

        function initEmailForm(emailToast) {
            const emailToastForm = document.getElementById('emailToastForm');
            const emailToastFormGroups = emailToastForm.querySelectorAll('.form-group');
            const successMessage = document.querySelector('.email-toast .success-message');

            emailToastForm.addEventListener('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: '/api/federal-loan-reminder',
                    method: 'POST',
                    data: {
                        name: document.getElementById('emailToastNameInput').value,
                        email: document.getElementById('emailToastEmailInput').value,
                    },
                    success() {
                        successMessage.classList.remove('d-none');
                        successMessage.setAttribute('aria-hidden', 'false');

                        // For Accessibility Reasons - set the form groups to hidden after submission
                        for(let i = 0; i < emailToastFormGroups.length; i++) {
                            emailToastFormGroups[i].setAttribute('aria-hidden', 'true');
                        }

                        // Automatically Remove the toast after a timer
                        setTimeout(function() {
                            emailToast.classList.remove('active', 'see-more');
                        }, 5000);
                    }
                });
            });
        }
    </script>
@endpush

<aside
    class="email-toast px-5 pt-5 bg-white shadow text-center border-light"
    aria-labelledby="emailToastHeading"
    aria-describedby="emailToastDescription"
>
    <span
        title="Close Email Prompt"
        class="close-email-toast p-2"
        aria-hidden="true"
    >
        <i class="fal fa-times text-muted"></i>
    </span>
    <h4
        id="emailToastHeading"
        class="mb-4 text-primary"
    >
        Got Federal Loans?
    </h4>
    <button class="see-more-button btn mb-4">
        See More
    </button>
    <h6
        id="emailToastDescription"
        class="mb-4"
    >
        Sign up for a one-time reminder to refinance once the federal forbearance period ends.
    </h6>
    <div class="col-12 col-lg-9 m-auto px-0">
        <form id="emailToastForm">
            <div class="form-row position-relative">
                <div
                    aria-hidden="true"
                    class="success-message d-none bg-white flex-column justify-content-center align-items-center
                    fade-in"
                >
                    <p class="font-weight-bold mb-0">
                        You got it!
                    </p>
                    <p class="font-weight-bold mb-5">
                        We'll be in touch when it's time for you to refi.
                    </p>
                    <img alt="Juno Logo" src="{{ url('/img/logo/juno-logo.png') }}" height="40">
                </div>

                <div class="form-group text-left col-12">
                    <input
                        type="name"
                        class="form-control"
                        placeholder="Enter your name here"
                        id="emailToastNameInput"
                        required
                    >
                </div>
                <div class="form-group text-left col-12">
                    <input
                        type="email"
                        class="form-control"
                        placeholder="Enter your email here"
                        id="emailToastEmailInput"
                        required
                    >
                </div>
                <div class="form-group text-left col-12 text-center">
                    <button
                        type="submit"
                        class="btn btn-primary btn-block mb-2"
                    >
                        Remind Me to Refi
                    </button>
                </div>
            </div>
        </form>
        <p class="text-muted font-weight-light text-sm mb-3">
            <small>
                We do not sell or share your information with anyone.
            </small>
        </p>
    </div>
</aside>
