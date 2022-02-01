@push('footer-scripts')
    <script>
        initEmailForm();

        function initEmailForm() {
            const emailForm = document.getElementById('emailForm');
            const emailFormGroups = emailForm.querySelectorAll('.form-group');
            const successMessage = emailForm.querySelector('.success-message');
            const errorMessage = emailForm.querySelector('.error-message');

            emailForm.addEventListener('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: '/api/federal-loan-reminder',
                    method: 'POST',
                    data: {
                        name: document.getElementById('emailToastNameInput').value,
                        email: document.getElementById('emailToastEmailInput').value,
                    },
                    complete() {
                        successMessage.classList.remove('d-none');
                        successMessage.setAttribute('aria-hidden', 'false');

                        // For Accessibility Reasons - set the form groups to hidden after submission
                        for(let i = 0; i < emailFormGroups.length; i++) {
                            emailFormGroups[i].classList.add('d-none');
                            emailFormGroups[i].setAttribute('aria-hidden', 'true');
                        }
                    },
                });
            });
        }
    </script>
@endpush

<div class="col-12 mb-5" id="emailForm">
    <h4 class="green-underline mb-4">Got Federal Loans?</h4>
    <p>
        0% interest until October 2021? 10k of loan forgiveness from the government?
        <br><br>
        Sign up for the latest updates on 0% interest and loan forgiveness.
    </p>
    <form action="{{ url('/api/federal-loan-reminder') }}" id="emailToastForm">
        <div class="flex flex-col position-relative">
            <div
                aria-hidden="true"
                class="w-full success-message d-none py-5 mx-auto flex-column text-center justify-content-center align-items-center
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

            <div class="form-group text-left col-12 col-sm-8 mx-auto">
                <input
                    type="name"
                    class="form-control"
                    placeholder="Enter your name here"
                    id="emailToastNameInput"
                    required
                >
            </div>

            <div class="form-group text-left col-12 col-sm-8 mx-auto">
                <input
                    type="email"
                    class="form-control"
                    placeholder="Enter your email here"
                    id="emailToastEmailInput"
                    required
                >
            </div>

            <div class="form-group text-left col-12 col-sm-8 mx-auto text-center">
                <button
                    type="submit"
                    class="btn btn-primary btn-block mb-2"
                >
                    Keep me updated
                </button>
            </div>
        </div>
    </form>
</div>
