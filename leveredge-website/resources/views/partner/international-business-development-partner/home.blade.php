@extends('template.public')

@section('content')
    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                Hi {{ $partner->name }},
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <table class="table">
                @foreach($partner->referredUsers as $subPartner)
                    @php
                        /** @var \App\User $subPartner */
                    @endphp

                    @if($subPartner->partnerProfile
                        && $subPartner->partnerProfile->partnerType
                        && $subPartner->partnerProfile->partnerType->type == 'Sub Tier - International Business Development Partner')
                        <tr>
                            <td colspan="2"><strong>{{ $subPartner->name }}</strong></td>
                        </tr>
                        @foreach($subPartner->partnerProfile->contractType->contractTypeMetrics as $contractTypeMetric)
                            @php
                                /** @var App\ContractTypeMetric $contractTypeMetric */
                            @endphp
                            <tr>
                                <td>
                                    {{ $contractTypeMetric->metric->title }}
                                </td>
                                <td>
                                    {{ $contractTypeMetric->metric->computeValue($subPartner) }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="py-5"></div>
@endsection
