@extends('template.public')

@section('content')
    <div class="py-4 py-lg-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 col-md-5">
                <img src="{{ asset('/img/landing-balloon.png') }}" class="img-fluid">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <h4 class="primary mb-3">Landing on the deal recommended for you</h4>
                <div class="progress" style="height: 32px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

        </div>
    </div>

    <div class="py-5"></div>
@endsection


@push('footer-scripts')
    <script>
        current_progress = 0,
        step = 5;

        $(document).ready(function(){
            console.log('fitirng');
            interval = setInterval(function() {
                current_progress += step;
                progress = current_progress

                $(".progress-bar")
                    .css("width", progress + "%")
                    .attr("aria-valuenow", progress)
                if (progress >= 100){
                    clearInterval(interval);
                    window.location.replace("/member/negotiation-group/"+ {{$negotiationGroupUser->negotiationGroup->id}} );
                }
            }, 100);
        })
    </script>
@endpush
