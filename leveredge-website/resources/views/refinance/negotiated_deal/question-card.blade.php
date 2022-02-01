<div class="card">
    <div class="card-header bg-white" id="heading{{ $id }}">
        <h5 class="mb-0">
            <a data-toggle="collapse" data-target="#collapse{{ $id }}" aria-expanded="false" aria-controls="collapse{{ $id }}" href="#collapse{{ $id }}">
                {{ $heading }}
            </a>
        </h5>
    </div>

    <div id="collapse{{ $id }}" class="collapse" aria-labelledby="heading{{ $id }}">
        <div class="card-body">
            {!! $body !!}
        </div>
    </div>
</div>
