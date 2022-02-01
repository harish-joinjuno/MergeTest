@push('header-scripts')
    <style>
        .timeline-step {
            position:relative;
        }

        .timeline-step:not(:last-of-type):after {
            content: '';
            position:absolute;
            width:100%;
            height:1px;
            background:#E7E8E7;
            top:15px;
            z-index:-1;
        }

        .timeline-step.number-background:before {
            top:5%;
            font-family: "CooperMediumBT", serif;
            left:50%;
        }

        .timeline-step i {
            color:#E7E8E7;
        }

        .timeline-step.complete i {
            color:#488C89;
        }

        .timeline-step.complete:after {
            background:#488C89;
        }
    </style>
@endpush

@if(!empty($steps))
    <div class="row text-center mx-0 my-5">
        @for($i = 0; $i < $steps; $i++)
            <div
                class="col px-0 timeline-step {{ $i + 1 < $active ? 'complete' : '' }} {{ !empty($numberBackgrounds) ? 'number-background' : '' }}"
                data-number="0{{ $i + 1 }}"
            >
                <i
                    class="{{ $i + 1 === $active ? 'far text-primary' : 'fas' }} fa-circle bg-white position-relative"
                    style="font-size:12px;"
                ></i>
                @if(empty($hideStepLabel))
                    <p class="text-dark small">
                        {{ $stepLabel ?? 'Step' }} {{ $i + 1 }}
                    </p>
                @endif
            </div>
        @endfor
    </div>
@endif
