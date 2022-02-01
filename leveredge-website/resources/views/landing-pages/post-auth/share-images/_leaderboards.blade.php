<div class="col-12 col-lg-10 offset-sm-2 mb-3">
    <h2 class="text-center">Top Shares</h2>
</div>
<div class="d-flex flex-column align-items-end green-backdrop mb-5 pb-5 px-0">
    @include('landing-pages.post-auth.share-images.partials._leaderboard-item', [
        'standing' => '1',
        'avatar' => asset('/img/male-avatar-1.png'),
        'name' => 'Matt P.',
        'total' => '14',
    ])
    @include('landing-pages.post-auth.share-images.partials._leaderboard-item', [
        'standing' => '2',
        'avatar' => asset('/img/female-avatar-1.png'),
        'name' => 'Alex L.',
        'total' => '10',
    ])
    @include('landing-pages.post-auth.share-images.partials._leaderboard-item', [
        'standing' => '3',
        'avatar' => asset('/img/male-avatar-2.png'),
        'name' => 'Mike R.',
        'total' => '8',
    ])
</div>
<div
    class="bg-secondary px-3 px-lg-4 py-4 position-absolute rounded shadow"
    style="bottom:-20px;left:-1px;z-index:1;"
>
    <p class="mb-0">Join them by sharing your link with others.</p>
</div>
