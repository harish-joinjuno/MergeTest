@extends('template.public')

@section('content')
    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="post">
                    @csrf
                    <div class="form-group">
                        <select class="form-control" name="magic_login_link_id">
                            @foreach($magicLoginLinks as $magicLoginLink)
                                <option value="{{ $magicLoginLink->id }}">{{ $magicLoginLink->slug }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Download Magic Links
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="py-5"></div>
@endsection
