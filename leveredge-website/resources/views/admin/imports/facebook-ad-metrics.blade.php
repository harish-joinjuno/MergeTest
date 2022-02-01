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
                <div class="row mt-4">
                    <div class="col">
                        <div class="header">
                            <h1 class="h1">Update Facebook Ad Metrics Table</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ route('facebook_ad_metrics.template') }}" download>
                                Download Template
                            </a>
                        </h3>
                    </div>
                    <div class="col-12 mb-3">
                        <h3>
                            Upload Rows
                        </h3>
                        <form method="post" action="{{ route('facebook_ad_metrics.import') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <input id="file-input" name="template_file" type="file"/>
                            </div>

                            <button type="submit" id="submit-upload" class="d-none btn btn-primary">Upload</button>
                        </form>
                    </div>
                    <div class="col-12 mb-3">
                        @php
                            $timezone = \Illuminate\Support\Str::upper(\Carbon\CarbonTimeZone::create('America/New_York')->getAbbreviatedName(true));
                        @endphp
                        <p>Current Time: {{ now()->timezone('America/New_York')->format('F d Y H:i A') }} {{ $timezone }}</p>
                        <p>Last Successful Data Upload: {{ \App\FacebookAdMetric::orderByDesc('updated_at')->first()->updated_at->format('F d Y H:i A') }} {{ $timezone }}</p>
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

