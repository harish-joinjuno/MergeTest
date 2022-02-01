<div class="container-fluid py-5 {{ $backgroundColor ?? '' }}">
    <div class="container narrow my-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-4 text-center">
                <img src="{{ $image }}" class="img-fluid" style="width:250px">
            </div>
            <div class="col-12 col-md-6 offset-md-2 text-center text-md-left">
                <h6 class="font-weight-bold">{!! $tag !!}</h6>
                <h2>{{ $heading }}</h2>
                <p>{!! $description !!}</p>
            </div>
        </div>
    </div>
</div>
