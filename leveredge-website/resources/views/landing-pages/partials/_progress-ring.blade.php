@php
    $circumference = $circumference ?? (80 * 2 * pi());
@endphp

<div class="d-flex flex-column align-items-center justify-content-center text-center position-relative col-12
col-sm-auto">
    <svg
        class="progress-ring"
        width="200"
        height="200"
        data-progress="{{ $currentProgress }}"
    >
        <circle
            stroke="#F0F0F4"
            stroke-width="10"
            fill="transparent"
            r="80"
            cx="100"
            cy="100"
        />
        <circle
            class="progress-ring__circle"
            stroke="currentColor"
            stroke-width="15"
            fill="transparent"
            stroke-linecap="round"
            r="80"
            cx="100"
            cy="100"
            style="
                color:#B3DAD9;
                transition: 0.35s stroke-dashoffset;
                transform: rotate(-90deg);
                transform-origin: 50% 50%;
                stroke-dasharray: {{ $circumference}}, {{ $circumference }};
                stroke-dashoffset: {{ $circumference - (min($currentProgress, 100) / 100) * $circumference }};

            "
        />
    </svg>

    {!! $slot !!}
</div>
