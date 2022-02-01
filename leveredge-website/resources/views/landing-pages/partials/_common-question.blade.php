@push('header-scripts')
    <style>
        .common-questions {
            padding:0 2rem;
        }
        .common-questions .dropdown .icon {
            margin-top:2rem;
        }
        .common-questions .dropdown-trigger {
            padding:2rem!important;
        }
        .common-questions .dropdown .dropdown-content {
            padding-left:2rem!important;
            padding-right:2rem!important;
        }
        @media screen and (max-width:768px) {
            .common-questions {
                padding:0;
            }
            .common-questions .dropdown-trigger {
                padding:1rem!important;
            }
            .common-questions .dropdown .dropdown-content {
                padding-left:1rem!important;
                padding-right:1rem!important;
            }
        }
    </style>
@endpush

<div class="container-fluid bg-white py-5">
    <div class="container my-5">
        <div class="row">
            <div class="col-xs-12 col-sm-6 text-right">
                <p><strong>Common question:</strong></p>
                <h1 class="off-black">Why should I refinance my student loans?</h1>
                <div class="col text-center px-0">
                    <img
                        aria-hidden="true"
                        src="{{ asset('/assets/images/timeline-img3.png') }}"
                        alt="File folder with cheque"
                        style="width:200px;max-width:100%;"
                    >
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="col-xs-12 common-questions mt-5">
                    @foreach($questions as $question)
                        @include('landing-pages.partials._dropdown', [
                            'trigger' => $question['question'],
                            'content' => $question['answer'],
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
