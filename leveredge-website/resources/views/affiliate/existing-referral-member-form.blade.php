<form method="POST" action="{{ url('/dashboard') }}" class="mt-3">
    @csrf

    <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>

        <input id="email" type="email" class="form-control{{ $errors->existing_member_form->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->existing_member_form->has('email'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->existing_member_form->first('email') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary">
            {{ __('View Dashboard') }}
        </button>
    </div>
</form>
