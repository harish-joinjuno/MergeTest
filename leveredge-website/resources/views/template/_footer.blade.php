<section id="footer">
    <div class="container text-white">
        <div class="row">
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <p class="mt-5">
                            We are on a mission to increase access to and reduce the financial burden of higher education.
                        </p>
                    </div>

                    <div class="col-12 col-lg-4 offset-lg-1">
                        <h2 class="mt-5">Who We Are</h2>
                        <ul>
                            <li><a href="{{ url('/about-us') }}">Who We Are</a></li>
                            <li><a href="{{ url('/reviews') }}">Reviews</a></li>
                            <li><a href="{{ url('/accessibility') }}">Accessibility</a></li>
                            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                        </ul>
                    </div>

                    <div class="col-12 col-lg-4">
                        <h2 class="mt-5">Products</h2>
                        <ul>
                            <li><a href="{{ url('/loans/graduate') }}">Graduate Student Loans</a></li>
                            <li><a href="{{ url('/loans/undergraduate') }}">Undergraduate Student Loans</a></li>
                            <li><a href="{{ url('/refinance-campaign') }}">Refinance Student Loans</a></li>
                            <li><a href="{{ url('/insurance/international-health') }}">International Health Insurance</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-6 mt-4 col-lg-2 mt-lg-5">
                <img src="{{ url('/img/lady-under-tree.png') }}" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <hr>

                <p class="text-footer-disclaimer">
                    Disclaimers: Product name, logo, brands, and other trademarks featured or referred to within
                    Juno are the property of their respective trademark holders. Please consult a licensed
                    financial professional before making any financial decisions. This site is not endorsed or
                    affiliated with the U.S. Department of Education.
                </p>

                @stack('custom-disclaimers')
                @foreach(App\Facades\FootNote::getFootNotes() as $index => $content)
                    <span class="text-footer-disclaimer text-light d-flex">
                        {{ ++$index }}&nbsp;-&nbsp;{!! $content !!}
                    </span>
                @endforeach

                <hr>

                <p class="text-footer-disclaimer">
                    ©{{ date('Y') }} LeverEdge Association. All rights reserved. | <a href="{{ url('/how-we-make-money') }}">How we make money</a> | <a href="{{ url('privacy') }}">Privacy Policy</a> | <a href="{{ url('/terms-of-use') }}">Terms of Use</a>
                </p>
            </div>
        </div>
    </div>


</section>
