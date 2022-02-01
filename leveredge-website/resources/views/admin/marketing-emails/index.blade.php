@extends('template.public')

@section('content')

    <div id="safeApp">
        <div class="jumbotron bg-white">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header">
                            <h1 class="h1">Manage Marketing Emails Table</h1>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ route('download-marketing-emails') }}" download>
                                Download Current Table
                            </a>
                        </h3>
                    </div>
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ route('add-new-rows') }}">Add New Rows to Table</a>
                        </h3>
                    </div>
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ route('delete-rows') }}">Delete Existing Rows from Table</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
