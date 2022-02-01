<form class="mt-4" method="get" action="{{ url('/register') }}">
    @csrf
    <div class="form-group text-left mb-0">
        <div class="input-group mb-3">
            <input class="form-control" type="email" name="email" id="email" placeholder="Email Address">
            <div class="input-group-append">
                <button id="submit-enroll-form-button" class="btn btn-primary">Get Started</button>
            </div>
        </div>
    </div>
</form>
