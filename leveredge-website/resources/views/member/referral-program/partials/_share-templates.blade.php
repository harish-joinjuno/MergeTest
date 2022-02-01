@push('header-scripts')
    <style>
        textarea {
            resize: none;
            background:none!important;
            outline:none!important;
            box-shadow:none!important;
        }
        .border-dashed {
            border-width:2px!important;
            border-style:dashed!important;
        }
    </style>
@endpush

@push('footer-scripts')
    <script>
        var addthis_share = {
            title: "",
            url: " ",
        }

        $(document).ready(function() {
            const wrapper = $('#{{ $uniqueId }}');
            const prevButton = wrapper.find('.prev-button');
            const nextButton = wrapper.find('.next-button');
            const hiddenInput = wrapper.find('.share-messages');
            const shareMessages = JSON.parse(hiddenInput.val());
            const shareMessageInput = wrapper.find('.share-message-input');
            const referralLink = hiddenInput.data('referralLink');
            const copyButton = wrapper.find('.copy-button');
            const oldTitle = copyButton.attr('data-original-title');
            let currentIndex = 0;

            prevButton.click(function() {
                currentIndex -= 1;
                setValue();
            });
            nextButton.click(function() {
                currentIndex += 1;
                setValue();
            });
            copyButton.click(function() {
                shareMessageInput.select();
                document.execCommand('copy');
                copyButton
                    .attr('data-original-title', 'Copied to Clipboard!')
                    .tooltip('show');

                mixpanel.track("Copy_Link");

                setTimeout(function() {
                    shareMessageInput.blur();
                    copyButton
                        .attr('data-original-title', oldTitle)
                        .tooltip('show');
                }, 2500);
            });

            setValue();

            function setValue() {
                if(currentIndex > shareMessages.length - 1) {
                    currentIndex = 0
                } else if(currentIndex < 0) {
                    currentIndex = shareMessages.length - 1;
                }
                shareMessageInput.text(shareMessages[currentIndex] + ' ' + referralLink);
                addthis_share.title = shareMessages[currentIndex];
                addthis_share.url = referralLink;
            }
        });
    </script>
@endpush

<div
    id="{{ $uniqueId }}"
    class="row justify-content-center"
>
    <div class="col-12 col-lg-6">
        <div class="col border border-dashed">
            <div class="row" style="background-color:#EDF6F5;">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <button class="prev-button btn btn-block px-0 text-primary">
                                <i class="fas fa-chevron-left mr-md-3"></i>
                                <span class="d-none d-md-inline">Prev</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="next-button btn btn-block px-0 text-primary">
                                <span class="d-none d-md-inline">Next</span>
                                <i class="fas fa-chevron-right ml-md-3"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <button
                        class="copy-button btn btn-block text-primary"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Copy to Clipboard"
                    >
                        Copy

                        <i class="fas fa-paste ml-3"></i>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col form-group text-center pt-3">
                    <input
                        class="share-messages"
                        type="hidden"
                        value="{{ json_encode($shareMessages) }}"
                        data-referral-link="{{ $referralLink }}"
                    >
                    <textarea
                        cols="30"
                        rows="6"
                        class="form-control border-0 share-message-input"
                    ></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
