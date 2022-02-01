@extends('template.public')

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h2>Dashboards</h2>
                <p>
                    The data displayed here has been moved to tableau dashboards used more frequently
                </p>


                <ul>
                    @foreach($dashboards as $dashboard)
                    <li>
                        <a target="_blank" href="{{ $dashboard['url'] }}">{{ $dashboard['label'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
