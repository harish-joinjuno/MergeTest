<form class="form" action="{{ url('join') }}" method="post">
@csrf

    <!-- Name -->
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
        @endif
    </div>

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


    <!-- Product -->
    <div class="form-group">
        <label for="product">{{ __('I Need A') }}</label>

        <select id="product" class="form-control{{ $errors->has('product') ? ' is-invalid' : '' }}" name="product" required>
            <option @if( old('product') == "MBA Student Loan" ) selected @endif value="MBA Student Loan">MBA Student Loan</option>
            <option @if( old('product') == "Law Student Loan" ) selected @endif value="Law Student Loan">Law Student Loan</option>
            <option @if( old('product') == "Medical Student Loan" ) selected @endif value="Medical Student Loan">Medical Student Loan</option>
            <option @if( old('product') == "Dental Student Loan" ) selected @endif value="Dental Student Loan">Dental Student Loan</option>
            <option @if( old('product') == "Pharma Student Loan" ) selected @endif value="Pharma Student Loan">Pharma Student Loan</option>
            <option @if( old('product') == "Refinance Loan" ) selected @endif value="Refinance Loan">Refinance Loan</option>
        </select>

        @if ($errors->has('product'))
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('product') }}</strong>
                            </span>
        @endif

    </div>


    <div class="form-group mb-0 mt-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Join Now') }}
        </button>
    </div>

</form>
