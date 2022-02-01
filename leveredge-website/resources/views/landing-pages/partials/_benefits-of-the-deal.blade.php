@push('header-scripts')
    <style>
        .benefits-list dd {
            margin:0;
            line-height:2rem;
        }
        .benefits-list dd:nth-child(odd) {
            background:linear-gradient(0deg,#EDF6F5,#EDF6F5),linear-gradient(180deg,#f3f4ed,#fff 50%);
        }
        .benefits-list dd:nth-child(even) {
            background:#fff;
        }
        .arrow-icon {
            color:#2F706B;
            font-size:1.75rem;
            vertical-align:middle;
            margin-right:1rem;
        }
    </style>
@endpush

<div class="container-fluid py-5 bg-light">
    <div class="container text-center  px-0 my-5">
        <h4
            id="benefitsOfTheDealHeading"
            class="off-black mb-5 underlined"
        >
            {{ $benefitsOfTheDealHeading ?? 'Benefits of the negotiated deal' }}
        </h4>
        <img
            aria-hidden="true"
            src="{{ asset('/img/students-on-bench-better.png') }}"
            alt="Students with a laptop and a tree in the background"
            class="my-5"
            style="width:360px;max-width:100%;"
        >
        <div class="benefits-list col-xs-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 px-0">
            @if(!empty($benefits))
                <dl
                    aria-labelledby="benefitsOfTheDealHeading"
                    class="list-style-none text-left rounded-lg overflow-hidden"
                >
                    @foreach($benefits as $benefit)
                        <dd class="p-5">
                            <span class="arrow-icon">&#45;&#62;</span>
                            {!! $benefit !!}
                        </dd>
                    @endforeach
                </dl>
            @endif
        </div>
    </div>
</div>
