<div class="container-fluid py-5 {{ $bgColor ?? '' }}">
    <div class="container my-lg-5">
        <div class="row align-items-center">
            <div class="col-12 col-sm-4 text-center {{ !empty($imageRight) ? 'order-md-2' : '' }}">
                <img
                    src="{{ $image ?? asset('/img/better-loans.png') }}"
                    alt="Flavor Image"
                    style="max-width:200px;"
                >
            </div>
            <div class="col-12 col-sm-8">
                <h4
                    class="text-secondary-green number-background"
                    data-number="{{ $number ?? '01' }}"
                >
                    {{ $heading }}
                </h4>
                <p>
                    {!! $text !!}
                </p>
            </div>
        </div>
    </div>
</div>
