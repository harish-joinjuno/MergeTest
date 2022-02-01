@extends('template.public')

@section('content')

    <div class="jumbotron bg-white">
        <div id="safeApp">
            <div class="container">
                @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="row">
                    <div class="col">
                        <div class="alert alert-success">
                            {{ \Illuminate\Support\Facades\Session::get('success') }}
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <h3>
                            <a href="{{ url('admin/imports') }}">Back</a>
                        </h3>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="header">
                            <h1 class="h1">Upload Laurel Road Refinance Report</h1>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 mb-3">
                        <h3>
                            Upload Report
                        </h3>
                        <p>
                            You may download the report, and without opening it, upload it here.
                        </p>
                        <form method="post" action="{{ route('laurel_road_refinance_report.import') }}" enctype="multipart/form-data">
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

