<div class="d-flex flex-column col-6 col-md-4 col-lg-2 p-3">
    <div class="card text-center">
        <form action="{{ route('user-profile.choose-loan-type') }}" method="post">
            @csrf
            <input value="{{ $nextPage }}" name="next_page" type="hidden" />
            <input value="{{ $value }}" name="loan_type" type="hidden" />
            <div class="card-body pb-0">
                <img
                    class="img-fluid"
                    src="{{ asset('/img/loan-type/' .  $value . '.png') }}"
                >
                <p
                    class="loan-type-title"
                    style="height:4em;"
                >{{ $title }}</p>
            </div>

            <div class="card-footer bg-white border-0 align-content-end">
                <input class="btn btn-primary" type="submit" id="{{ $value }}" value="Select">
            </div>
        </form>
    </div>
</div>


@push('header-scripts')
    <style>
        .loan-type-title{
            font-weight: 500;
            font-size: 16px;
        }
    </style>
@endpush
