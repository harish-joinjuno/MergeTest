@extends('template.public')

@section('content')

    <div class="jumbotron bg-white">
        <div id="safeApp">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3>
                            <a href="{{ url('admin/imports') }}">Back</a>
                        </h3>
                    </div>
                </div>
                @php
                    $allNotifications = session()->get('successfulImports') ?: [];
                    $successfulNotifications = array_filter($allNotifications, function ($item) {
                        return $item['type'] === 'success';
                    });
                    $infoNotifications = array_filter($allNotifications, function ($item) {
                        return $item['type'] === 'info';
                    });
                    $errorNotifications = array_filter($allNotifications, function ($item) {
                        return $item['type'] === 'danger';
                    });
                @endphp
                @if(! empty($allNotifications))
                    <div class="row mt-5">
                        <div class="col">
                            <strong>Total ({{count($allNotifications)}}) </strong><br>
                            <strong>Successful ({{ count($successfulNotifications) }}) </strong><br>
                            <strong>Info ({{ count($infoNotifications) }}) </strong><br>
                            <strong>Error ({{ count($errorNotifications) }})</strong>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <div class="header">
                                <h1 class="h1">Status access the deals import</h1>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Access ID</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Loan Amount</th>
                                    <th>Status</th>
                                    <th>Message</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(session()->get('successfulImports') as $index => $row)
                                    @if ($row['type'] === 'danger')
                                        <tr class="alert alert-danger">
                                            <td colspan="6">{{ $row['message'] }}</td>
                                        </tr>
                                    @else
                                        <tr class="alert alert-{{ $row['type'] }}">
                                            <td>{{ $row['id'] }}</td>
                                            <td>{{$row['user_name'] }}</td>
                                            <td>{{$row['user_email'] }}</td>
                                            <td>{{$row['loan_amount'] }}</td>
                                            <td>{{$row['status'] }}</td>
                                            <td>{{$row['message'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <div class="row mt-4">
                    <div class="col">
                        <div class="header">
                            <h1 class="h1">Update Access the Deals Table</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ route('admin.imports.access-the-deals-template') }}" download>
                                Download Template
                            </a>
                        </h3>
                    </div>
                    <div class="col-12 mb-3">
                        <h3>
                            Upload updated Rows
                        </h3>
                        <form method="post" action="{{ route('admin.imports.access-the-deals.upload') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <input id="file-input" name="template_file" type="file"/>
                            </div>

                            <button type="submit" id="submit-upload" class="d-none btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#file-input').change(function () {
                $('#submit-upload').removeClass('d-none');
            })
        })
    </script>
@endpush

