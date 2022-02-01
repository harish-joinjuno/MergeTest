<div class="container mt-0 mb-0 pt-3 pb-4">
    <div class="row justify-content-center">
        <div class="col-9">

            <p class="text-center">
                AS FEATURED IN
            </p>

            @php

            $press_mentions = [
                ["Alone, students have no leverage to negotiate. But together, they can force lenders to compete.", url('/img/press-logo/above-the-law-horizontal.png')],

                ["No one has seen an approach exactly like Juno’s.", url('/img/press-logo/boston-globe-logo-light.png')],

                ["Last fall, two HBS admits took a look at interest rates... Then they got organized.", url('/img/press-logo/poets-and-quants-logo-bg-light.png')],

                ["", url('/img/press-logo/wall-street-journal-bg-light.png')]

            ];
            @endphp

            <div class="card-deck mt-3">
                @foreach($press_mentions as $press)
                    @unless($loop->last)
                        <div class="card border-0 bg-transparent">
                            <div class="card-body text-center">
                                <p class="text-small">
                                    "{{ $press[0] }}"
                                </p>
                            </div>

                            <div class="card-footer border-0 pt-0 bg-transparent">
                                <img src="{{ $press[1] }}" class="img-fluid">
                            </div>
                        </div>
                    @endunless
                @endforeach
            </div>



        </div>
    </div>
</div>
