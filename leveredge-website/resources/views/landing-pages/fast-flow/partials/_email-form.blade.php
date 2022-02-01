<div class="container text-center py-4" style="max-width:720px;">
    <h2 class="mb-4 off-black">
        We negotiated this deal for our community. Now we’re sharing it with the world for
        <span
            style="text-decoration:underline dotted"
            data-toggle="tooltip"
            title="We charge lenders a fee that is set at the beginning of the process.
            The only way for a lender to win the auction is to offer the lowest rates to our members"
        >free</span>.
    </h2>
    <img src="{{ asset('/img/portion-of-team.png') }}" class="img-fluid">
    <h6 class="my-4" style="max-width:420px;margin:0 auto;">
        <a
            href="https://calendly.com/leveredge-team/member-intro-call"
            class="text-dark"
            target="_blank"
            rel="noreferrer noopener"
        >
            <u>
                <strong>Book a time with us now</strong>
            <svg
                aria-hidden="true"
                focusable="false"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                height="15"
                width="15"
                class="d-inline ml-1 mb-1"
            >
                <path fill="currentColor" d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,
                    16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,
                    432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,
                    377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z">
                </path>
            </svg>,
            </u>
        </a>
        @if(empty($hideForm))or fill out the information below to see the deal.@endif
    </h6>

    @if(empty($hideForm))
        <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
            <form
                class="form text-left"
                action="{{ route('fast-flow-name-and-email') }}"
                method="post"
            >
                @csrf

                <div class="form-group">
                    <label for="role">First Name</label>
                    <input autofocus
                           id="first_name"
                           type="text"
                           class="form-control {{ $errors->has('first_name') ? 'is-invalid border-danger' : 'border-dark' }}"
                           name="first_name"
                           value="{{ old('first_name','' ) }}"
                           placeholder="First Name"
                           required
                    >
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group mb-5">
                    <label for="zip_code">Email Address</label>
                    <input
                        id="email"
                        type="email"
                        class="form-control {{ $errors->has('email') ? 'is-invalid border-danger' : 'border-dark' }}"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="name@email.com"
                        required
                        autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group text-center mb-4">
                    <button type="submit" class="btn btn-block btn-secondary rounded-pill">
                        {{ __('See the deal') }}
                    </button>
                </div>
            </form>
        </div>

    <div class="text-center">
        <a class="text-dark font-normal" href="{{ url('/fast-flow/skip-step') }}">
            <u style="font-weight:600;">Skip this step*</u>
        </a>

        <p class="mt-4">{{ $formDisclaimer ?? '' }}</p>
    </div>
    @endif
</div>
