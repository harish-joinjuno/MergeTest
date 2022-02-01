{{-- To only show 1 set of rates, just omit the $altRates arrays --}}

@php
    $fixedRates = null;
    $variableRates = null;
    $altFixedRates = null;
    $altVariableRates = null;
    if (!empty($rates)) {
        $fixedRates = $rates->rateProperties->filter(function ($property) {
            return $property->type === 'fixed';
        });
        $variableRates = $rates->rateProperties->filter(function ($property) {
            return $property->type === 'variable';
        });
        $termTitle = ($rates->termTitle ?: 'Term') . ($rates->termFootNote ?: '<sup class="foot-note-marker">1</sup>') ;
        $aprTitle = ($rates->aprTitle ?: 'APR') . ($rates->aprFootNote ?: '<sup class="foot-note-marker">2</sup>');
    }
    if (!empty($altRates)) {
        $altFixedRates = $altRates->rateProperties->filter(function ($property) {
            return $property->type === 'fixed';
        });
        $altVariableRates = $altRates->rateProperties->filter(function ($property) {
            return $property->type === 'variable';
        });
    }
@endphp

@push('header-scripts')
    <style>
        .rates-table {
            background:url(/assets/images/Peel.png) no-repeat;
            background-position:bottom -1px left -1px;
            box-shadow:0 2px 5px rgba(0,0,0,.1);
            border-radius:5px 5px 5px 40px;
            padding:3rem;
        }
        .radio-group {
            border-radius:5px;
            border:1px solid #67B6B3;
            box-shadow:0 0 5px #B3DAD9;
            margin:0;
        }
        .radio-group:focus-within {
            box-shadow:0 0 8px #67B6B3;
            z-index:5;
        }
        .radio-group .field {
            padding:.5rem 1rem;
        }
        .radio-group .field:last-child {
            border-left:1px solid #B3DAD9;
            border-radius:0 5px 5px 0;
            background: linear-gradient(0deg,#EDF6F5,#EDF6F5),linear-gradient(180deg,#f3f4ed,#fff 50%);
        }
        .field {
            position:relative;
        }
        .field input {
            position:absolute;
            width:100%;
            height:100%;
            opacity:0;
            top:0;
            left:0;
        }
        .field label {
            padding-left:30px;
            font-size:16px;
            font-weight:500;
            outline:none;
            position:relative;
        }
        .field label:before {
            content: '';
            position:absolute;
            top:2px;
            left:0;
            height:20px;
            width:20px;
            border-radius:50%;
            border:2px solid #EDEDEB;
        }
        .field input:checked ~ label:before {
            background:#67B6B3;
            border-color:transparent;
        }
        .field input:checked ~ label:after {
            content: '';
            position:absolute;
            top:8px;
            left:6px;
            height:8px;
            width:8px;
            background:#fff;
            border-radius:50%;
        }
        .field input,
        .field label {
            margin:0;
        }
        .rates-table tr {
            border-top:1px solid #EDEDEB;
        }
        .rates-table tbody tr:nth-child(odd) {
            background: linear-gradient(0deg,#EDF6F5,#EDF6F5),linear-gradient(180deg,#f3f4ed,#fff 50%);
        }
        @media screen and (max-width:768px) {
            .rates-table {
                padding:2rem;
            }
        }
    </style>
@endpush

@push('footer-scripts')
    <script>
        window.addEventListener('load', function() {
            function toggleElement(element, show) {
                if (show) {
                    element.classList.remove('d-none');
                    element.setAttribute('aria-hidden', 'false');
                } else {
                    element.classList.add('d-none');
                    element.setAttribute('aria-hidden', 'true');
                }
            }
            function findTableToShow(data) {
                if (data.alt === true) {
                    if (data.rates === 'variable') {
                        return 'altVariableRatesTable';
                    }
                    return 'altFixedRatesTable';
                }
                if (data.rates === 'fixed') {
                    return 'fixedRatesTable';
                }
                return 'variableRatesTable';
            }
            const rateTables = document.querySelectorAll('.rate-table');
            let data = {
                'alt': false,
                'rates': 'variable',
            };
            document.addEventListener('change', function(event) {
                const element = event.target
                if (element.classList.contains('rates-table-input')) {
                    let name = element.name;
                    let value = element.value;
                    if(name === 'alt') {
                        value = value === 'true';
                    }
                    data[name] = value;
                }
                const tableToShow = findTableToShow(data);
                for (let i = 0; i < rateTables.length; i++) {
                    const showTable = rateTables[i].getAttribute('id') === tableToShow;
                    toggleElement(rateTables[i], showTable);
                }
            });
        });
    </script>
@endpush

<div class="container-fluid bg-light-green py-5">
    <div class="rates-table container bg-white my-5">
        <div class="row">
            <div class="col-12 col-md-5 mb-5 text-center text-md-left">
                <h4 class="d-inline-block underlined mb-5">
                    Rates
                </h4>
                <br>
                <h2 class="mb-5">{{ $title ?? '' }}</h2>
                <p class="mb-5">
                    {!!  $description ?? '' !!}
                </p>
                <a
                    href="{{ $ctaLink ?? '' }}"
                    class="rates-button btn btn-lg bg-secondary text-center font-weight-bold px-5"
                >
                    {{ $ctaText ?? '' }}
                </a>
            </div>

            <div class="col-12 col-md-7">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        @if(!empty($altFixedRates) && !empty($altVariableRates))
                            <div class="radio-group row no-wrap mb-3">
                                <div class="field col-auto">
                                    <input
                                        type="radio"
                                        id="altRates"
                                        name="alt"
                                        value="true"
                                        class="rates-table-input"
                                    >
                                    <label for="altRates" tabindex="-1">
                                        Medical
                                    </label>
                                </div>

                                <div class="field col">
                                    <input
                                        type="radio"
                                        id="mainRates"
                                        name="alt"
                                        value="false"
                                        class="rates-table-input"
                                        checked
                                    >
                                    <label for="mainRates" tabindex="-1">
                                        Non-medical
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="radio-group row no-wrap mb-3">
                            <div class="field col">
                                <input
                                    type="radio"
                                    id="fixedRates"
                                    name="rates"
                                    value="fixed"
                                    class="rates-table-input"
                                >
                                <label for="fixedRates" tabindex="-1">
                                    Fixed
                                </label>
                            </div>

                            <div class="field col">
                                <input
                                    type="radio"
                                    id="variableRates"
                                    name="rates"
                                    value="variable"
                                    class="rates-table-input"
                                    checked
                                >
                                <label for="variableRates" tabindex="-1">
                                    Variable
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!empty($fixedRates))
                    <div
                        id="fixedRatesTable"
                        aria-hidden="true"
                        class="row m-0 px-3 rate-table d-none"
                    >
                        <table class="col text-center mt-3 mb-5">
                            <thead>
                                <tr class="row p-3">
                                    <th class="col-6">{!! $termTitle !!}</th>
                                    <th class="col-6">{!! $aprTitle !!}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fixedRates as $rate)
                                    <tr class="row p-3">
                                        <td class="col-6">{{ $rate->term }}</td>
                                        <td class="col-6">{{ $rate->apr }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if(!empty($variableRates))
                    <div
                        id="variableRatesTable"
                        class="row m-0 px-3 rate-table"
                    >
                        <table class="col text-center mt-3 mb-5">
                            <thead>
                            <tr class="row p-3">
                                <th class="col-6">{!! $termTitle !!}</th>
                                <th class="col-6">{!! $aprTitle !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($variableRates as $rate)
                                <tr class="row p-3">
                                    <td class="col-6">{{ $rate->term }}</td>
                                    <td class="col-6">{{ $rate->apr }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if(!empty($altFixedRates))
                    <div
                        id="altFixedRatesTable"
                        aria-hidden="true"
                        class="row m-0 px-3 rate-table d-none"
                    >
                        <table class="col text-center mt-3 mb-5">
                            <thead>
                            <tr class="row p-3">
                                <th class="col-6">{!! $termTitle !!}</th>
                                <th class="col-6">{!! $aprTitle !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($altFixedRates as $rate)
                                <tr class="row p-3">
                                    <td class="col-6">{{ $rate->term }}</td>
                                    <td class="col-6">{{ $rate->apr }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if(!empty($altVariableRates))
                    <div
                        id="altVariableRatesTable"
                        aria-hidden="true"
                        class="row m-0 px-3 rate-table d-none"
                    >
                        <table class="col text-center mt-3 mb-5">
                            <thead>
                            <tr class="row p-3">
                                <th class="col-6">{!! $termTitle !!}</th>
                                <th class="col-6">{!! $aprTitle !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($altVariableRates as $rate)
                                <tr class="row p-3">
                                    <td class="col-6">{{ $rate->term }}</td>
                                    <td class="col-6">{{ $rate->apr }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <p>APRs include Auto Pay rate reduction where applicable {!! ($rates->autoPayFootNote ?: '<sup class="foot-note-marker">3</sup>') !!}  </p>
            </div>
        </div>
    </div>
</div>
