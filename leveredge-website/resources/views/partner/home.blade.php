@extends('template.public')

@php
/** @var User $partner */use App\User;
@endphp

@section('content')

    <div class="py-3"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                Hi {{ $partner->name }},
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <table class="table">
                    @foreach($partner->partnerProfile->contractType->contractTypeMetrics as $contractTypeMetric)
                        @php
                            /** @var App\ContractTypeMetric $contractTypeMetric */
                        @endphp
                    <tr>
                        <td>
                            {{ $contractTypeMetric->metric->title }}
                        </td>
                        <td>
                            {{ $contractTypeMetric->metric->computeValue($partner) }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        @if($partner->partnerProfile->contractType->show_referrals_list)
        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <h3>Referred Users</h3>
                <table class="table">
                    @foreach($partner->referredUsers as $referredUser)
                        @php
                            /** @var \App\User $referredUser */
                        @endphp
                        <tr>
                            <td>
                                {{ $referredUser->name }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @endif
        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <x-partner-claim :partner=user() />
            </div>
        </div>

    </div>

    <div class="py-5"></div>
@endsection
