<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Reviews</h2>
            <div class="separator"></div>
        </div>
    </div>

    <div class="row mt--3 justify-content-center">

        @php
            $images = [
                "/img/reviews/facebook-ad-1-testimonial-largest-font.png",
                "/img/reviews/facebook-ad-2-testimonial-largest-font.png",
                "/img/reviews/facebook-ad-3-testimonial-largest-font.png",
                "/img/reviews/facebook-ad-4-testimonial-largest-font.png",
                "/img/reviews/facebook-ad-5-testimonial-largest-font.png",
                "/img/reviews/facebook-ad-6-testimonial-largest-font.png",
            ];
        @endphp


        <div class="col-12 col-md-4">

            @include('common.reviews-caroulsel',['images' => $images])

        </div>

    </div>

</div>
