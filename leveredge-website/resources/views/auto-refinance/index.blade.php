@extends('template.public')
@section('content')
    <div class="container">
        <h1>Auto Refinance</h1>

        <a href="{{route('auto_refinance-get_redirect')}}"  class="btn btn-primary btn-lg">Get Started</a>

        <h3>Debug - (client id.: {{getClient()->id}})</h3>
        <p>Experiments: </p>
        <ul>
            @foreach(getClient()->experimentClients as $experimentClient)
                <li>{{$experimentClient->experiment->name}} (id.:  {{$experimentClient->experiment_id}})</li>
            @endforeach
        </ul>
    </div>
@endsection
