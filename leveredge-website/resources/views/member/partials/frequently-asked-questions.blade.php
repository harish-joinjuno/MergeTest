@if($negotiationGroup->faqCategories->isNotEmpty())
    <div class="container">
        <div class="row">
            <div class="col-12">
                <section class="section" id="faqs">
                    <h1 class="text-center">Frequently Asked Questions</h1>
                    @foreach($negotiationGroup->faqCategories()->has('negotiationGroupFaqs')->get() as $faqId => $faq)
                        <div class="row faq-row">
                            <div class="col-md-3 d-none d-md-block">
                                <div class="faq-title">
                                    {{ $faq->name }}
                                </div>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="accordion" id="faq-{{ $faqId }}">
                                    @foreach($faq->negotiationGroupFaqs as $question)
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">
                                                    <button
                                                        class="btn-faq d-flex align-items-center"
                                                        type="button"
                                                        data-toggle="collapse"
                                                        data-target="#question-{{ $question->id }}"
                                                        aria-expanded="true"
                                                        aria-controls="question-{{ $question->id }}">
                                                        <span class="fas fa-plus mr-3"></span>
                                                        {{ $question->title }}
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="question-{{ $question->id }}"
                                                 class="collapse"
                                                 aria-labelledby="headingOne"
                                                 data-parent="#accordionExample">
                                                <div class="card-body section-content">
                                                    {!! $question->body !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>
            </div>
        </div>
    </div>
@endif
