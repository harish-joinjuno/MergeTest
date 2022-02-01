<form method="POST" action="{{ url('/dashboard/new') }}" class="mt-3">
    @csrf

    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>

        <input id="name" type="text" class="form-control{{ $errors->new_member_form->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

        @if ($errors->new_member_form->has('name'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->new_member_form->first('name') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>

        <input id="email" type="email" class="form-control{{ $errors->new_member_form->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->new_member_form->has('email'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->new_member_form->first('email') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary">
            {{ __('Join Now') }}
        </button>
    </div>
</form>
