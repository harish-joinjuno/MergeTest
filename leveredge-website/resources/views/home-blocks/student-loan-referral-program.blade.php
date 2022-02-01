<li class="list-group-item">
    <div class="d-block d-md-flex w-100 justify-content-between">
        <div>
            <h3>Invite Your Friends & Earn Rewards</h3>
            <p class="mt-3">Don’t leave your friends behind! For each friend who takes the deal: <br> <strong>You get $25. They get $25. You unlock prizes.</strong>
            </p>
            <img src="{{ url('/img/referral-prizes/referrals-prizes-summary.png') }}" class="img-fluid mt-2 d-none d-lg-inline">
            <img src="{{ url('/img/referral-prizes/referrals-prizes-summary-vertical.png') }}" class="img-fluid mt-2 img-thumbnail d-lg-none">
            <form>
                <div class="input-group mt-4">
                    <input
                        type="text"
                        class="form-control text-center"
                        value="{{ Auth::user()->referral_link }}"
                        id="unique-url-{{ isset($unique_url_number) ? $unique_url_number : "1" }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary copy-button" type="button" data-clipboard-target="#unique-url-{{ isset($unique_url_number) ? $unique_url_number : "1" }}">Copy</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="ml-3">
            <!-- TODO: Send to Laurel Road Application Directly -->
            <a class="btn btn-sm btn-outline-primary mt-3 mt-md-0" href="{{ url('/referral-program') }}">Track Rewards</a>
        </div>
    </div>
</li>
