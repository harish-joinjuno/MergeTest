<!-- Step Section -->
<div class="jumbotron bg-primary-50%">
    <div class="container space-top-2 space-top-lg-3 space-bottom-lg-2">
        <!-- Title -->
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
            <span class="d-block small font-weight-bold text-cap mb-2">Always improving your outcome</span>
            <h2>How it works</h2>
        </div>
        <!-- End Title -->

        <!-- Step -->
        <ul class="step step-md step-centered">
            <li class="step-item">
                <div class="step-content-wrapper">
                    <span class="step-icon step-icon-soft-primary">1</span>
                    <div class="step-content">
                        <h3>Tell us your goals</h3>
                        <p>Trying to reduce your interest rate? Increase cash flow? Pay off faster?
                            During on-boarding, let us know your goals and credit history. Then, we'll get to work.
                        </p>
                    </div>
                </div>
            </li>

            <li class="step-item">
                <div class="step-content-wrapper">
                    <span class="step-icon step-icon-soft-primary">2</span>
                    <div class="step-content">
                        <h3>Our AI will find you the lowest rates, every single day</h3>
                        <p>Using predictive algorithms and quotes based on soft credit checks, we'll look for the best option to meet your goals every day.</p>
                    </div>
                </div>
            </li>

            <li class="step-item">
                <div class="step-content-wrapper">
                    <span class="step-icon step-icon-soft-primary">3</span>
                    <div class="step-content">
                        <h3>We’ll handle the paperwork</h3>
                        <p>If you enroll in Robo-Refi, we'll go ahead and refinance your loans for you! If not, we'll send you an email with a summary of our recommendations.</p>
                    </div>
                </div>
            </li>
        </ul>
        <!-- End Step -->
    </div>
</div>

<!-- End Step Section -->

@php
    $faqs = [
        'How does Juno make money?' => 'We charge lenders a small fee when they refinance your loans. Lenders usually spend much more money in marketing, and the savings are passed on to you. We only refinance your loans if we find better conditions, so if we can’t save you money we don’t earn anything.',
        'Is Juno a lender?' => 'That’s right. We are a technology-enabled startup that helps customers save money on their loans. We work with top lenders to find the best conditions for everyone, but we are 100% independent and always work in your best interest. ',
        'How will Juno be able to refinance my loans?' => 'During onboarding, we ask you to sign a Limited Power of Attorney. This allows us to act on your behalf, in your best interest as we interact with lenders/banks etc.<br>While you may be aware of this authorization used in other, more general contexts, we use it extremely specifically. When you sign up, you’re limiting us to only act on your behalf with regards to refinancing your debt – nothing else.',
        'How do you know what is in my best interest?' => 'During onboarding, we ask you several questions that ensure we know your preferences. This ensures we are acting in your best interest. You can update your preferences at any time. Further, if we are ever in doubt, if a refinance offer is in your best interest or not, we will ask you.',
        'How does Refinancing work?' => 'Whenever you take a loan, the lender defines the interest rate you will pay. Think of the rate as the price of the loan, the higher it is, the more interest you will end up paying. Rates change all the time, but if you stick with your original loan, you will not benefit from the lower interest.',
        'How does Juno help with refinancing?' => 'Juno’s Robo Refi does the work for you. Our proprietary engine continuously checks the best rate for you in the market, and it automatically refinances your loans if it finds better conditions. ',
    ];
    $i = 0;
@endphp

<!-- FAQs Section -->
<div class="bg-img-hero">
    <div class="container position-relative z-index-2">
        <div class="w-md-80 w-lg-60 text-center mx-md-auto">
            <h1>FAQ</h1>
            <p>Search our FAQ for answers to anything you might ask.</p>
        </div>
    </div>
</div>
<div class="container space-2 space-bottom-lg-3">
    <div class="row justify-content-lg-center">
        <div class="col-lg-8">
            <div id="basics" class="space-bottom-1">
                <!-- Basics Accordion -->
                <div id="basicsAccordion">
                    @foreach($faqs as $question => $answer)
                    <!-- Card -->
                    <div class="card shadow-none mb-3">
                        <div class="card-header card-collapse" id="basicsHeading{{ $i++ }}">
                            <a class="btn btn-link btn-block d-flex justify-content-between card-btn collapsed bg-white px-0" href="javascript:;" role="button" data-toggle="collapse" data-target="#basicsCollapse{{ $i }}" aria-expanded="false" aria-controls="basicsCollapse{{ $i }}">
                                {{ $question }}
                                <span class="card-btn-toggle">
                                  <span class="card-btn-toggle-default">&plus;</span>
                                  <span class="card-btn-toggle-active">&minus;</span>
                                </span>
                            </a>
                        </div>
                        <div id="basicsCollapse{{ $i }}" class="collapse" aria-labelledby="basicsHeading{{ $i }}" data-parent="#basicsAccordion">
                            <div class="card-body px-0">
                                {!! $answer !!}
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                    @endforeach
                </div>
                <!-- End Basics Accordion -->
            </div>
        </div>
    </div>
</div>
<!-- End FAQs -->

<!-- CTA Section -->
<div class="container">
    <div class="w-lg-85 mx-lg-auto">
        <div class="card bg-primary text-white overflow-hidden p-4">
            <div class="row justify-content-md-start align-items-md-center text-center text-md-left">
                <div class="col-md-6 offset-md-3 mb-3 mb-md-0">
                    <h3 class="text-white mb-1">Got a question?</h3>
                    <p class="text-white-70 mb-0">We'd love to talk about how we can help you.</p>
                </div>
                <div class="col-md-3 text-md-right">
                    <a class="btn btn-light transition-3d-hover" href="mailto:hello@joinjuno.com">Contact Us</a>
                </div>
            </div>

            <!-- SVG Component -->
            <figure class="w-25 d-none d-md-block content-centered-y ml-n4">
                <img class="img-fluid" src="{{ asset("assets/robo-refi/svg/illustrations/communication.svg") }}" alt="Image Description">
            </figure>
            <!-- End SVG Component -->
        </div>
    </div>
</div>
<!-- End CTA Section -->

<div class="my-5 py-5"></div>
