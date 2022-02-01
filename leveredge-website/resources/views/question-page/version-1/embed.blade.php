@push('footer-scripts')
    <script>
        $(document).ready(function() {
            let requestQueue = [];
            let requestInterval = 0;
            const csrfToken = $('input[name="_token"]').val();
            const currentSlug = '{{ $questionPage->slug }}';
            const trackInputUrl = '/record-response';

            requestInterval = setInterval(function() {
                sendNextQueuedRequest();
            }, 1000);
            toggleInputs();

            $(document).on('change', function(event) {
                const element = event.target;
                const config = {
                    question_id: element.getAttribute('id'),
                    response: element.value,
                };

                if(!element.matches('.no-track')) {
                    queueRequest(config);
                    toggleInputs();
                }

                if(element.matches('.card-radio')) {
                    const form = $(element).closest('form');

                    form.submit();
                }
            });

            function toggleInputs() {
                const formGroups = $('.form-group.dynamic');
                formGroups.each(function(index, item) {
                    const visibilityRule = $(item).find('input[type="hidden"]')[0];
                    const rules = JSON.parse($(visibilityRule).val());
                    if (rules == null) {
                        $(item).removeClass('d-none');
                    } else {
                        parseRules(item, rules);
                    }
                });
            }

            function parseRules(item, rules) {
                if (rules.method === 'based-on-value-of-input-on-page') {
                    const fieldToCheck = $('[name="' + rules.field_name + '"]');
                    const value = fieldToCheck.val();

                    if (rules.visible_values.includes(value)) {
                        $(item).removeClass('d-none');
                    } else {
                        $(item).addClass('d-none');
                    }
                }

                if (rules.method === 'based-on-value-of-multiple-inputs-on-page') {
                    let passedRule = false;
                    for (rule of rules.inputs) {
                        const fieldToCheck = $('[name="' + rule.field_name + '"]');
                        const value = fieldToCheck.val();

                        if (! passedRule && rule.visible_values.includes(value)) {
                            $(item).removeClass('d-none');
                            passedRule = true;
                        } else {
                            if (! passedRule) {
                                $(item).addClass('d-none');
                            }
                        }
                    }
                }

                if(rules.method === 'based-on-value-of-callable-multiple-inputs-on-page') {
                    let dateRule = false;
                    for (rule of rules.inputs) {
                        const fieldToCheck = $('[name="' + rule.field_name + '"]');
                        const value = fieldToCheck.val();

                        if (value && ! dateRule && moment(value)[rule.callable](moment().format('YYYY-MM-DD'))) {
                            $(item).removeClass('d-none');
                            dateRule = true;
                        } else {
                            if (! dateRule) {
                                $(item).addClass('d-none');
                            }
                        }
                    }
                }

                if(rules.method === 'based-on-value-of-callable-multiple-inputs-and-other-input-on-page') {
                    let passedRules = false;
                    for (rule of rules.inputs) {
                        const fieldToCheck = $('[name="' + rule.field_name + '"]');
                        const value = fieldToCheck.val();

                        if (value && ! passedRules && moment(value)[rule.callable](moment().format('YYYY-MM-DD'))) {
                            passedRules = true;
                            break;
                        }
                    }
                    console.debug(passedRules, 'passed rules');
                    if(passedRules) {
                        const fieldToCheck = $('[name="' + rules.input.field_name + '"]');
                        const value = fieldToCheck.val();
                        if (rules.input.visible_values.includes(value)) {
                            $(item).removeClass('d-none');
                        } else {
                            $(item).addClass('d-none');
                        }
                    } else {
                        $(item).addClass('d-none');
                    }

                }
                if(rules.method === 'is-less-based-on-value-of-input-on-page') {
                    const fieldToCheck = $('input[name="' + rules.field_name + '"]');
                    const value = fieldToCheck.val();

                    if (value && value < rules.visible_value) {
                        $(item).removeClass('d-none');
                    } else {
                        $(item).addClass('d-none');
                    }
                }
            }

            function queueRequest(data) {
                let config = {
                    url: trackInputUrl,
                    data: data,
                }
                requestQueue.push(config);
            }

            function sendNextQueuedRequest() {
                if(requestQueue.length) {
                    sendRequest(requestQueue[0]);
                }
            }

            function sendRequest(config) {
                $.ajax({
                    headers : {
                        'X-CSRF-TOKEN' : decodeURIComponent(csrfToken),
                    },
                    method: 'POST',
                    url: config.url,
                    data: config.data,
                    beforeSend: function() {
                        requestQueue.shift();
                    },
                    success: function(response) {
                        if(response) {
                            toggleInputs(response);
                        }
                    },
                });
            }
        });
    </script>
@endpush

<div class="container mt-3">
    @foreach($questionPage->questions as $key => $question)
        @if(!$question->shouldSkip())
            @include($question->show_view, ['question' => $question])
        @endif
    @endforeach

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="form-group mb-0">
                @if(! $questionPage->shouldHideSubmissionButton())
                    <button type="submit" class="btn btn-primary btn-block">
                        @if($questionPage->isLastPageInFlow())
                            Submit
                        @else
                            Next
                        @endif
                    </button>
                @endif

                @if(!$questionPage->isFirstPageInFlow())
                    <a class="btn btn-link btn-block" href="{{ url($questionPage->previousPageInFlow()->url)  }}">
                        {{ __('Previous') }}
                    </a>
                @endif
            </div>

        </div>
    </div>

</div>
