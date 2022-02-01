@php
    $variableRates = $rate->rateProperties->filter(function ($property) {
        return $property->type === 'variable';
    });

    $fixedRates = $rate->rateProperties->filter(function ($property) {
        return $property->type === 'fixed';
    })
@endphp
<div class="form-inner" style="padding-bottom: 100px;">
    <div class="left-title">
        <div class="title">
            <h4>Rates</h4>
        </div>
        <h3 class="mb-4">{!! $title !!}</h3>
        <h5 class="black px-3 pl-lg-0 pr-lg-5">
            {!!  $rate->description !!}
        </h5>
        <a target="_blank" href="{{ $rate->cta_link }}" class="btn-voila cta mt-5">{{ $rate->cta_text }}</a>
    </div>
    <div class="right-form">
        <div class="inner-content">
            <div class="lable-div">
                <div class="radio-box">
                    <input type="radio" id="fixed-or-variable-rate-map-fixed" name="fixed-or-variable-rate-map" value="Fixed" @if(isset($default) && $default == 'fixed') checked="" @endif />
                    <label for="Fixed">Fixed</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="fixed-or-variable-rate-map-variable" name="fixed-or-variable-rate-map" value="Variable" @unless(isset($default) && $default == 'fixed') checked="" @endunless />
                    <label for="Variable">Variable</label>
                </div>
            </div>
            <div class="form-content">
                <div class="fcol-2">
                    <span>Term</span>
                    <ul>
                        @foreach($variableRates as $variableRate)
                            <li class="variable-rates" style="display: none;">{{ $variableRate->term }}</li>
                        @endforeach

                        @foreach($fixedRates as $fixedRate)
                            <li class="fixed-rates" style="display: none;">{{ $fixedRate->term }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="fcol-2">
                    <span>APR <sup class="foot-note-marker">{{ $rate->foot_note_marker ?: '' }}</sup></span>
                    <ul>
                        @foreach($variableRates as $variableRate)
                            <li class="variable-rates" style="display: none;">{{ $variableRate->apr }}</li>
                        @endforeach

                        @foreach($fixedRates as $fixedRate)
                            <li class="fixed-rates" style="display: none;">{{ $fixedRate->apr }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @if(! is_null($rate->notes_below_rates))
                @foreach($rate->notes_below_rates as $note)
                    @if($loop->first)
                        <p class="mt-4">{!! $note !!}</p>
                    @else
                        <p class="mt-2">{!! $note !!}</p>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

</div>


@push('footer-scripts')
    <script>
        $(document).ready(function () {
            $('input:radio[name="fixed-or-variable-rate-map"]').change(function(){
                var variableSelected = $('#fixed-or-variable-rate-map-variable').is(':checked');
                var fixedSelected = $('#fixed-or-variable-rate-map-fixed').is(':checked');
                if( variableSelected ){
                    $('.fixed-rates').hide();
                    $('.variable-rates').show();
                }
                if( fixedSelected ){
                    $('.fixed-rates').show();
                    $('.variable-rates').hide();
                }
            });
            $('input:radio[name="fixed-or-variable-rate-map"]').trigger('change');
        });
    </script>
@endpush
