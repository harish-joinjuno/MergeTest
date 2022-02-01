@push('header-scripts')
    <style>
        .hidden-range {
            width:100%;
            cursor:pointer;
            position:relative;
            opacity:0;
            z-index:20;
        }

        .custom-handle {
            position:absolute;
            height:30px;
            width:30px;
            box-shadow:0 0 5px rgba(0,0,0,.2);
            border-radius:50%;
            margin-top:-15px;
            background:white;
            pointer-events:none;
            left:0;
            top:50%;
            z-index:10;
        }

        .custom-handle svg {
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%, -50%);
        }

        .progress-background {
            position:absolute;
            top:50%;
            margin-top:-4px;
            left:0;
            width:100%;
            height:8px;
            border-radius:4px;
            background:#C4C4C4;
            pointer-events:none;
            z-index:0;
        }
        .drag-progress, .current-progress {
            position:absolute;
            background:#F4D471;
            border-radius:4px;
            top:0;
            left:0;
            height:100%;
            width:0;
        }
        .drag-progress {
            background:#F4D471;
            z-index:1;
        }
        .current-progress {
            background:#278D87;
            z-index:2;
            width:20%;
        }
        .current-handle {
            position:absolute;
            text-align:center;
            white-space:nowrap;
            right:0;
            top:50%;
            margin-top:-12px;
            border-radius:50%;
            height:24px;
            width:24px;
            border:5px solid #fff;
            background:#278D87;
            z-index:3;
        }
        .current-handle:before {
            content: 'Current Level';
            position: absolute;
            font-size:14px;
            top:-30px;
            transform:translateX(-50%);
        }
        .goals-wrapper {
            height:50px;
            position:relative;
        }
        .goals-wrapper:before {
            content: '0';
            font-size:14px;
            color:#C4C4C4;
            position:absolute;
            left:0;
            top:15px;
            transform:translateX(-50%);
        }
        [data-goal]:nth-of-type(2) {
            border-left:1px solid #C4C4C4;
        }
        [data-goal] {
            height:15px;
            border-right:1px solid #C4C4C4;
            position:relative;
        }
        [data-goal]:after {
            content: attr(data-goal);
            font-size:14px;
            color:#C4C4C4;
            position:absolute;
            right:0;
            top:15px;
            transform:translateX(50%);
        }
    </style>
@endpush

@push('footer-scripts')
    <script>
        $(document).ready(function () {
            const hiddenRange = $('.hidden-range');
            const maximumAmount = hiddenRange.attr('max');
            const customHandle = $('.custom-handle');
            const dragProgress = $('.drag-progress');
            const dynamicPrice = $('.dynamic-price');
            const goals = $('[data-goal]').map(function (index, item) {
                return {
                    price: $(item).data('price'),
                    goal: $(item).data('goal'),
                }
            });
            let currentValue = {{ $currentGoalIndex }};
            let progressPercent = 0;
            updateProgress();
            hiddenRange.on('input', function (event) {
                currentValue = hiddenRange.val();
                updateProgress();
            });

            function updateProgress() {
                progressPercent = (currentValue / maximumAmount) * 100;
                dynamicPrice.text('$' + goals[currentValue].price);
                customHandle.css({
                    left: progressPercent + '%',
                    transform: 'translateX(-' + progressPercent + '%)',
                });

                dragProgress.css({
                    width: progressPercent + '%',
                });
            }
        });
    </script>
@endpush

<div class="col-12 col-sm-8 bg-white shadow p-5 text-center">
    <h2 class="text-primary mb-4">Find out the price</h2>
    <div class="row align-items-center mb-4">
        <div class="col-6 text-right">
            <h5>
                Price
            </h5>
        </div>
        <div class="col-6 text-left">
            <h2 class="dynamic-price text-primary">
                ${{ $goals[$currentGoalIndex]['price'] }}
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12 px-0 position-relative">
            <div
                class="custom-handle"
                aria-hidden="true"
                style="left:{{$progressPercent}}%;transform:translateX(-{{$progressPercent}}%);"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    version="1.1"
                    width="20"
                    height="20"
                    viewBox="0 0 512 512"
                >
                    <g>
                    </g>
                    <path d="M162.642 148.337h56.034v215.317h-56.034v-215.316z" fill="#242424"/>
                    <path d="M293.356 148.337h56.002v215.317h-56.002v-215.316z" fill="#242424"/>
                </svg>
            </div>
            <div class="progress-background" aria-hidden="true">
                <div class="current-progress"
                     style="width:{{ $progressPercent }}%;"
                >
                    <span
                        class="current-handle"
                        data-amount="{{ $goals[$currentGoalIndex]['min'] }}"
                        style="transform:translateX({{ 100 - $progressPercent }}%);"
                    ></span>
                </div>
                <div class="drag-progress"></div>
            </div>

            <input
                type="range"
                class="hidden-range"
                value="0"
                min="0"
                max="{{ count($goals) - 1 }}"
                data-toggle="tooltip"
                data-placement="top"
                title="Try Me"
            >
        </div>
    </div>
    <div class="row goals-wrapper mx-0">
        @foreach($goals as $index => $goal)
            <div
                class="col {{ $index === 0 ? 'd-none' : '' }}"
                data-goal="{{ $goal['min'] }}"
                data-price="{{ $goal['price'] }}"
            ></div>
        @endforeach
    </div>

    <p class="mb-0 text-primary">
        The more people, the cheaper it is for everyone.
    </p>
</div>
