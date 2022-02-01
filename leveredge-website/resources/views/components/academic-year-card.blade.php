<li class="list-group-item">
<form action="{{ route('user-profile.store-academic-year') }}" method="post">
    @csrf
    <input type="hidden" name="academic_year" value="{{ $value }}" />
    <p class="academic-year-title d-inline">{{ $title }}</p>
    <button type="submit" id="{{ $id }}" class="btn btn-sm btn-primary float-right">Select</button>
</form>
</li>


@push('header-scripts')
    <style>
        .academic-year-title{
            font-weight: 500;
            font-size: 16px;
        }
    </style>
@endpush
