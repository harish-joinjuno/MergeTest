@extends('template.public')

@section('content')

    <div class="jumbotron bg-white">
        <div id="safeApp">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3>
                            <a href="{{ route('admin-marketing-emails') }}">Back</a>
                        </h3>
                    </div>
                </div>

                @if(! empty(session()->get('importValidations')))
                    <div class="row mt-5">
                        <div class="col">
                            <div class="header">
                                <h1 class="h1">Status of Add Rows Request</h1>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Row #</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(session()->get('importValidations') as $index => $row)
                                    <tr class="alert alert-{{ $row['type'] }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{$row['message'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <div class="row mt-4">
                    <div class="col">
                        <div class="header">
                            <h1 class="h1">Add New Rows to Marketing Emails Table</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ route('download-marketing-emails-template') }}" download>
                                Download Template
                            </a>
                        </h3>
                    </div>
                    <div class="col-12 mb-3">
                        <h3>
                            Upload new Rows
                        </h3>
                        <form method="post" action="{{ route('upload-template') }}" enctype="multipart/form-data">
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

