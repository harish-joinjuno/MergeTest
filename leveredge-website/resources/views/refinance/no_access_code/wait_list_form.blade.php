<form method="POST" action="{{ url('/negotiated-refinance-deal/no-access-code/wait-list') }}">
    @csrf

    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>

        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group mb-0">
        <div>
            <button type="submit" class="btn btn-primary">
                {{ __('Join the Wait List') }}
            </button>
        </div>
    </div>
</form>
