<div class="jumbotron mt-0 mb-0 pt-3 pt-md-0 pb-3 pb-md-0" id="welcome-logo-strip">
    <div class="container h-100 pt-0 pb-0 mt-0 mb-0">
        <div class="row h-100 justify-content-center">
            <div class="col-12 text-center">
            @php

                $press_mentions = [

                // ["Alone, students have no leverage to negotiate. But together, they can force lenders to compete.", url('/img/press-logo/above-the-law-horizontal.png')],


                    ["saving each student around $8,300 on their combined $25 million debt", url('/img/press-logo/wall-street-journal-bg-light-2.png')],


                    ["No one has seen an approach exactly like Juno’s.", url('/img/press-logo/boston-globe-logo-light.png')],



                    ["Two HBS admits took a look at interest rates... Then they got organized.", url('/img/press-logo/poets-and-quants-logo-bg-light.png')],

                     ["Together, students can force lenders to compete.", url('/img/press-logo/above-the-law-horizontal.png')],

                ];
            @endphp


            <!-- Mobile Only Header -->
                <p class="text-small d-md-none text-uppercase" style="color: #61717d;">
                    <strong>As Featured In</strong>
                </p>

                <!-- Desktop -->
                <div class="card-deck mt-2 mb-2">
                    @foreach($press_mentions as $press)
                        <div class="card border-0 bg-transparent">
                            <div class="card-body text-center">
                                <img src="{{ $press[1] }}" class="img-fluid" style="max-height: 24px;">
                                <p class="text-small mt-3">
                                    "{{ $press[0] }}"
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>



            </div>
        </div>
    </div>
</div>
