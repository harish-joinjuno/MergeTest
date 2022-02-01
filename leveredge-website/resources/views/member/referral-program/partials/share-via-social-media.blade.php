@push('footer-scripts')
    <script>
        $(document).ready(function() {
            addthis.addEventListener('addthis.menu.share', function(event) {
                const events = {
                    slack: 'Slack(button_pressed)',
                    linkedin: 'Linkedin(button_pressed)',
                }
                const eventData = events[event.data.service];

                if(eventData) {
                    mixpanel.track(events[event.data.service]);
                }
            });
        });
    </script>
@endpush

<div class="container my-5">
    <h1 class="text-center mb-5">Share via Social Media</h1>

    @include('member.referral-program.partials._share-templates', [
        'uniqueId' => 'slackShare',
        'referralLink' => Auth::user()->referral_link,
        'shareMessages' => [
            'Hey everyone, I just came across Juno for anyone in the market for student loan refinancing. They partner with lenders that offer the best rates and highest rewards in the market (up to $1000). Check them out here:',
            'Hey everyone, I heard about this company called Juno (started by some HBS alumni). They negotiate with lenders across the country so that you can secure a better deal than going to the lender directly. Hit me up if you have any questions!',
            'If anyone is looking to refinance their loans right now given the historically low interest rates I’d consider using Juno.',
            'For people looking to refinance their loans: Juno can secure loans for very low rates. They negotiate with lenders in bulk for professionals across the country. I’ve checked and their deal rate and cashback rewards are better than anything you would get from going directly to the private lenders.'
        ],
    ])

    <div class="row mt-4">
        <div class="col text-center">
            <div class="addthis_inline_share_toolbox"></div>
        </div>
    </div>
</div>
