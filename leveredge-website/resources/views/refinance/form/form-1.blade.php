<form class="form" action="{{ url('join/refi') }}" method="post">
    @csrf

    <!-- Name -->
    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>


    <!-- Email -->
    <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>


    <!-- Type -->
    <div class="form-group">
        <label for="type">{{ __('Type') }}</label>
            <select id="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                <option @if( old('type') == "Domestic Student" ) selected @endif value="Domestic Student">Domestic Student</option>
                <option @if( old('type') == "International Student" ) selected @endif value="International Student">International Student</option>
            </select>
            @if ($errors->has('type'))
                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('type') }}</strong>
        </span>
            @endif
    </div>

        <div class="form-group mb-0 mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Sign Up') }}
            </button>
        </div>

</form>
