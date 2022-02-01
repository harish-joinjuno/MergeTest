@php
    $isCommonbond = (isset($is_commonbond) && $is_commonbond) ? 1 : 0;
@endphp
<div class="form-inner" style="padding-bottom: 100px;">
    <div class="left-title">
        <div class="title">
            <h4>Rates</h4>
        </div>
        <h3 class="mb-4">{!! $title !!}</h3>
        <h5 class="black px-3 pl-lg-0 pr-lg-5">
            {!!  $description !!}
        </h5>
        <a target="_blank" href="{{ $cta_link }}" class="btn-voila cta mt-5">{{ $cta_text }}</a>
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
            @if($isCommonbond)
                <div class="form-content" id="fixed-helper-text" style="display: none">
                    <p>Commonbond also offers fixed rates, but we believe their best deal is for variable rates. For your best fixed rate option, go to <a href="{{ $recommendations_link }}">Earnest</a>. </p>
                </div>
            @endif
            <div class="form-content">
                <div class="fcol-2">
                    <span>Term<sup class="foot-note-marker">1</sup></span>
                    <ul>
                        @foreach($variable_rates as $variable_rate)
                        <li class="variable-rates" style="display: none;">{{ $variable_rate['term'] }}</li>
                        @endforeach

                            @foreach($fixed_rates as $fixed_rate)
                            <li class="fixed-rates" style="display: none;">{{ $fixed_rate['term'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="fcol-2">
                    <span>APR <sup class="foot-note-marker">2</sup></span>
                    <ul>
                        @foreach($variable_rates as $variable_rate)
                        <li class="variable-rates" style="display: none;">{{ $variable_rate['APR'] }}</li>
                        @endforeach

                        @foreach($fixed_rates as $fixed_rate)
                            <li class="fixed-rates" style="display: none;">{{ $fixed_rate['APR'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @foreach($notes_below_rates as $note)
                @if($loop->first)
                    <p class="mt-4">{!! $note !!}</p>
                @else
                    <p class="mt-2">{!! $note !!}</p>
                @endif
            @endforeach
        </div>
    </div>

</div>


@push('footer-scripts')
    <script>
        $(document).ready(function () {
            const isCommonbond =  {{ $isCommonbond }};
            $('input:radio[name="fixed-or-variable-rate-map"]').change(function(){
                var variableSelected = $('#fixed-or-variable-rate-map-variable').is(':checked');
                var fixedSelected = $('#fixed-or-variable-rate-map-fixed').is(':checked');
                if( variableSelected ){
                    $('.fixed-rates').hide();
                    $('.variable-rates').show();
                    if (isCommonbond) {
                        $('#fixed-helper-text').hide()
                    }
                }
                if( fixedSelected ){
                    $('.fixed-rates').show();
                    $('.variable-rates').hide();
                    if (isCommonbond) {
                        $('#fixed-helper-text').show()
                    }
                }
            });
            $('input:radio[name="fixed-or-variable-rate-map"]').trigger('change');
        });
    </script>
@endpush
