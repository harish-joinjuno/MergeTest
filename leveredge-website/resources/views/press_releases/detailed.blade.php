@extends('template.public')

@section('content')

    <div class="py-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{$release->title}}</h2>
                <div>
                    {!! $release->body !!}
                </div>
            </div>
        </div>
    </div>
    <div class="py-5"></div>

@endsection

