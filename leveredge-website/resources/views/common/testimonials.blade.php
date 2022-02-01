@php

$small_testimonials=[

    "The deal I was offered blew all of my other options completely out of the water, and is saving me thousands of dollars",

    "I initially went with SunTrust ... I sadly got a 6.7 rate ... I just got my order from Juno and it's 4.475!",

    "I've applied for over 20 loans last year, and this one gave me the best interest rate and flexibility on repayment terms.",
];

@endphp


<section id="testimonials" class="">

    <div class="container">
        <div class="row mb-3">
            <div class="col-12 text-center">
                <h4 class="fw-500">Reviews</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                <p class="mb-3">Students loved the rates they received through the negotiation process.</h4>
            </div>

            @foreach($small_testimonials as $testimonial)
                <div class="col-lg-4 col-12">
                    <div class="card testimonial-card negotiated-deal-shadow mt-4">
                        <div class="card-body text-center">

                            <img src="{{ url('/img/icons/testimonial-quote-icon.png') }}" height="70px" class="mt-4">

                            <p class="card-text mt-5">{{ $testimonial }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-12 mt-5 text-center">
                <a class="link" href="{{ url('/reviews') }}">READ ALL REVIEWS</a>
            </div>

        </div>
    </div>

</section>
