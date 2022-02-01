<form method="POST" action="{{ url('complete-guide-to-student-loans-for-business-school') }}" class="mt-5">
    @csrf
    <div class="form-group">
        <div class="input-group mb-3">
            <input name="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Download Now</button>
            </div>
        </div>
    </div>
</form>
