@push('header-scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection--multiple{
            overflow: hidden !important;
            height: auto !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #EDF6F5;
            color:#2F706B;
            border:none;
            padding:2px 0 2px 8px;
            margin-left: 10px;
            margin-top: 10px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            float:right;
            border:none;
            padding:0 8px;
        }
        .select2-container--default .select2-search--inline .select2-search__field {
            padding:2px 5px;
            margin-left: 10px;
            margin-top: 10px;
            width:100%!important;
        }
        .select2-container--default .select2-selection--multiple {
            padding-bottom:10px;
            padding-right:10px;
        }
    </style>
@endpush

@push('footer-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            const emailShares = $('#emailShares');
            const emailInviteButton = $('#emailInviteButton');
            emailShares.select2({
                placeholder: 'Enter emails here',
                width: '100%',
                tags: true,
                tokenSeparators: [',', ' '],
                maximumSelectionLength: 10,
            });

            emailInviteButton.on('click', function() {
                mixpanel.track('Share_email', {
                    'emails_entered': emailShares.val().length
                });
            });
        });
    </script>
@endpush

<div class="container my-5">
    <h1 class="text-center">Share via email</h1>
    <p class="small text-muted mb-5 text-center">
        Invite people to Juno by entering their emails.
        <br>
        We will send them an email and keep you in CC.
    </p>

    <div class="row justify-content-center">
            <div class="col-12 col-lg-6 text-center">
                <form action="{{ $emailRoute ?? route('share-via-email') }}" method="post">
                    @csrf
                    <select
                        name="emails[]"
                        id="emailShares"
                        multiple="multiple"
                        class="form-control"
                    >
                        <option disabled>You can add multiple emails by separating them with a return, space, or comma</option>
                    </select>

                    <button type="submit"
                        id="emailInviteButton"
                        class="btn btn-primary mt-4 py-3 px-5"
                    >
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send invite
                    </button>
                </form>
            </div>
            @error('emails')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @error('emails.*')
            <p class="text-danger">{{ $message }}</p>
            @enderror
    </div>
</div>
