@push('header-scripts')
    <style>
        .faq {
            box-shadow:0 2px 5px rgba(0,0,0,.1);
            border-radius:10px;
        }
    </style>
@endpush

<div class="container narrow bg-white faq my-5 mt-n5 slide-fade-in">
    <div class="row">
        <div class="col-12 p-5">
            <h5 class="font-weight-bold text-center">FAQs</h5>
        </div>
    </div>

    @foreach($faqs as $faq)
        @include('landing-pages.partials._dropdown', [
            'trigger' => $faq['question'],
            'content' => $faq['answer'],
        ])
    @endforeach
</div>
